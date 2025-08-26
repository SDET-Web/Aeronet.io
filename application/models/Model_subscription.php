<?php if (!defined("BASEPATH")) exit("No direct script access allowed");

class Model_subscription extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->library("braintree_lib");
    }

    public function Post($id, $plan, $aircrafts)
    {
        $this->load->library('braintree_lib');
        $response = $this->braintree_lib->createCustomer(
            ["account_email" => $this->session->userdata("user_email")]
        );

        if ($response["status"] == "success") {

            $customerId = $response["customerId"];
            $this->db->update("user", ["braintree_id" => $customerId]);

            $response = $this->braintree_lib->createPaymentMethod($customerId, $this->input->post("paymentMethod"));
            if ($response["status"] == "success") {
                $paymentToken = $response["paymentMethodToken"];


                $response = $this->braintree_lib->createSubscription($paymentToken, $plan, count($aircrafts));
                if ($response["status"] == "success") {

                    $data["user_id"] = $this->session->userdata("user_id");
                    $data["braintree_id"] = $response["id"];
                    $data["braintree_plan"] = $plan;
                    $data["price"] = $response["total"];
                    $data["ends_at"] = date("Y-m-d h:i:s", strtotime("+1 month", time()));
                    $data["nnumbers"] = count($aircrafts);

                    $this->db->insert("user_subscriptions", $data);
                    $subscriptionId = $this->db->insert_id();
                    foreach ($aircrafts as $aircraft) {
                        $this->db->insert("user_subscription_planes", ["subscription_id" => $subscriptionId, "aircraft_id" => $aircraft]);
                    }
                    $this->session->set_userdata("subscription", $this->GET($this->session->userdata("id")));
                    return true;
                } else {
                    push_message(implode("<br />", $response["message"]), true);
                    redirect("flight-dispatch-board/$id/addons/" . $plan);
                }
            } else {
                push_message(implode("<br />", $response["message"]), true);
                redirect("flight-dispatch-board/$id/addons/" . $plan);
            }
        } else {
            push_message(implode("<br />", $response["message"]), true);
            redirect("flight-dispatch-board/$id/addons/" . $plan);
        }
    }

    public function PostNew($plan, $aircrafts, $addons = [])
    {
        $currentSubscription = $this->db->from("user_subscriptions")->where("user_id", $this->session->userdata("user_id"))->get();
        if ($currentSubscription->num_rows() > 0) {
            if ($currentSubscription->num_rows() > 1) {
                $subscriptions = $currentSubscription->row();
                $this->db->where("id !=", $subscriptions->id)->delete('user_subscriptions');
                $currentSubscription = $this->db->from("user_subscriptions")->where("user_id", $this->session->userdata("user_id"))->get();
            }
        }


        $this->load->library('braintree_lib');
        $response = $this->braintree_lib->createCustomer(
            ["account_email" => $this->session->userdata("user_email")]
        );

        if ($response["status"] == "success") {

            $customerId = $response["customerId"];
            $this->db->update("user", ["braintree_id" => $customerId]);
            if ($plan == L8_PLAN_BASIC) {
                $data["user_id"] = $this->session->userdata("user_id");
                $data["braintree_id"] = '';
                $data["braintree_plan"] = $plan;
                $data["price"] = 0;
                $data["ends_at"] = date("Y-m-d h:i:s", strtotime("+1 month", time()));
                $data["nnumbers"] = 0;
                if ($currentSubscription->num_rows() > 0) {
                    $row = $currentSubscription->row();
                    if (strtotime($row->ends_at) <= time()) {
                        $this->db->where('id', $row->id)->update('user_subscriptions', $data);
                    }
                } else {
                    $this->db->insert("user_subscriptions", $data);
                }
                return true;
            } else {

                $subscription = $currentSubscription->row();
                // if ($subscription == L8_INSERT_ERROR || $subscription->trial_ends_at == null) {
                //     $data["user_id"] = $this->session->userdata("user_id");
                //     $data["price"] = 0;
                //     $data["ends_at"] = date("Y-m-d h:i:s", strtotime("+7 days"));
                //     $data["trial_ends_at"] = date("Y-m-d h:i:s", strtotime("+7 days"));
                //     $data["braintree_plan"] = $plan;
                //     $data["nnumbers"] = count($aircrafts);

                //     $subscriptionId = 0;
                //     if ($currentSubscription->num_rows() > 0) {
                //         $currentSubscription = $currentSubscription->row();
                //         $subscriptionId = $currentSubscription->id;
                //         $this->db->where("id", $currentSubscription->id)->update("user_subscriptions", $data);
                //     } else {
                //         $this->db->insert("user_subscriptions", $data);
                //         $subscriptionId = $this->db->insert_id();
                //     }

                //     foreach ($aircrafts as $aircraft) {
                //         $this->db->insert("user_subscription_planes", ["subscription_id" => $subscriptionId, "aircraft_id" => $aircraft]);
                //     }

                //     foreach ($addons as $addon) {
                //         $price = addon_prices($addon);
                //         $this->db->insert('user_subscription_addons', ['subscription_id' => $subscriptionId, 'type' => $addon, 'price' => $price, "created" => time()]);
                //     }


                //     return true;
                // } else {


                $response = $this->braintree_lib->createPaymentMethod($customerId, $this->input->post("paymentMethod"));
                if ($response["status"] == "success") {
                    $paymentToken = $response["paymentMethodToken"];
                    
                    $response = $this->braintree_lib->createSubscription($paymentToken, $plan, count($aircrafts));
                    if ($response["status"] == "success") {

                        $data["user_id"] = $this->session->userdata("user_id");
                        $data["braintree_id"] = $response["id"];
                        $data["braintree_plan"] = "$plan";
                        $total=$this->CalculateCts();
                        $data["price"] = $total;
                        $data["ends_at"] = date("Y-m-d h:i:s", $response["expire"]);
                         if ($response["trialDuration"] > 0 && $response["trialDuration"] != "") {
                                $data["trial_ends_at"] = date("Y-m-d h:i:s", $response["expire"]);
                            } 
                        $data["nnumbers"] = count($aircrafts);

                        $subscriptionId = 0;
                        if ($currentSubscription->num_rows() > 0) {
                            $currentSubscription = $currentSubscription->row();
                            $subscriptionId = $currentSubscription->id;
                            $this->db->where("id", $currentSubscription->id)->update("user_subscriptions", $data);
                        } else {
                            $this->db->insert("user_subscriptions", $data);
                            $subscriptionId = $this->db->insert_id();
                        }

                        foreach ($aircrafts as $aircraft) {
                            $this->db->insert("user_subscription_planes", ["subscription_id" => $subscriptionId, "aircraft_id" => $aircraft]);
                        }

                        foreach ($addons as $addon) {
                            $price = addon_prices($addon);
                            $this->db->insert('user_subscription_addons', ['subscription_id' => $subscriptionId, 'type' => $addon, 'price' => $price, "created" => time()]);
                        }


                        return true;
                    } else {
                        echo 'error three';
                        exit;
                        push_message(implode("<br />", $response["message"]), true);
                        redirect("flight-dispatch-board/subscribe/addons/l8premiumcts");
                    }
                } else {
                    echo 'error two';
                    exit;
                    push_message(implode("<br />", $response["message"]), true);
                    redirect("flight-dispatch-board/subscribe/addons/l8premiumcts");
                }
            }
            // }

        } else {
            push_message(implode("<br />", $response["message"]), true);
            echo 'error one';
            exit;
            redirect("flight-dispatch-board/subscribe/addons/l8premiumcts");
        }
        //redirect('logout');
    }

    public function Update($aircrafts)
    {
        $this->load->library('braintree_lib');
        $response = $this->braintree_lib->createCustomer(
            ["account_email" => $this->session->userdata("user_email")]
        );
        
        if ($response["status"] == "success") {

            $customerId = $response["customerId"];
            $this->db->update("user", ["braintree_id" => $customerId]);
            $currentSubscription = $this->db->from("user_subscriptions")->where("user_id", $this->session->userdata("user_id"))->get()->row();
            if ($currentSubscription->braintree_plan == L8_PLAN_PREMIUM_CTS) {
                $response = $this->braintree_lib->createPaymentMethod($customerId, $this->input->post("paymentMethod"));
                if ($response["status"] == "success") {
                    $paymentToken = $response["paymentMethodToken"];


                    $response = $this->braintree_lib->updateSubscription($paymentToken, $currentSubscription, count($aircrafts));
                    if ($response["status"] == "success") {

                        $data["user_id"] = $this->session->userdata("user_id");
                        $data["braintree_id"] = $response["id"];
                        $data["price"] = $response["total"];
                        $data["ends_at"] = date("Y-m-d h:i:s", $response["expire"]);
                        if ($response["trialDuration"] > 0 && $response["trialDuration"] != "") {
                        $data["trial_ends_at"] = date("Y-m-d h:i:s", $response["expire"]);
                        }
                        $data["nnumbers"] = count($aircrafts);

                        $subscriptionId = 0;
                        $subscriptionId = $currentSubscription->id;
                        $this->db->where("id", $currentSubscription->id)->update("user_subscriptions", $data);
                        $this->db->where("subscription_id", $subscriptionId)->delete("user_subscription_planes");
                        foreach ($aircrafts as $aircraft) {
                            $this->db->insert("user_subscription_planes", ["subscription_id" => $subscriptionId, "aircraft_id" => $aircraft]);
                        }
                        return true;
                    } else {
                        push_message(implode("<br />", $response["message"]), true);
                        redirect("flight-dispatch-board/subscribe/addons/l8premiumcts");
                    }
                } else {
                    push_message(implode("<br />", $response["message"]), true);
                    redirect("flight-dispatch-board/subscribe/addons/l8premiumcts");
                }
            }
        } else {
            push_message(implode("<br />", $response["message"]), true);
            redirect("flight-dispatch-board/subscribe/addons/l8premiumcts");
        }
    }

    public function CancelSubscription()
    {
        $this->load->library('braintree_lib');
        $subscription = $this->Get($this->session->userdata("user_id"));
        if ($subscription->trial_left > 0) {
            $this->db->where('id', $subscription->id)->update('user_subscriptions', [
                'trial_ends_at' => date('Y-m-d h:i:s', strtotime("-1 day", time())),
                'ends_at' => date('Y-m-d h:i:s', strtotime("-1 day", time()))
            ]);
        } else {
            $response = $this->braintree_lib->cancelSubscription($subscription->braintree_id);
            if ($response["status"] == "success") {
                push_message("Your subscription has been cancelled. It will expire on " . date("m/d/Y", strtotime($subscription->ends_at)));
                return true;
            } else {
                push_message($response["message"], true);
                return false;
            }
        }
    }

    public function Get($id)
    {
        $subscription_rs = $this->db->select("*, DATEDIFF(trial_ends_at, CURDATE()) as trial_left, DATEDIFF(ends_at, CURDATE()) as days_left")->from("user_subscriptions")->where("user_id", $id)->order_by('user_subscriptions.id desc')->get();
        if ($subscription_rs->num_rows() > 0) {
            $subscription = $subscription_rs->row();
            $response = $this->braintree_lib->getSubscription($subscription->braintree_id);
            // if (strtotime($subscription->ends_at) <= time()) {
            $response = $this->braintree_lib->getSubscription($subscription->braintree_id);
            if (Braintree_Subscription::ACTIVE == $response["subscription"] || (Braintree_Subscription::CANCELED && strtotime($response["expires"]) > time())) {
                $this->db->where("user_id", $id)->update("user_subscriptions", ["ends_at" => $response["expires"]]);
                $subscription_rs = $this->db->select("*, DATEDIFF(trial_ends_at, CURDATE()) as trial_left, DATEDIFF(ends_at, CURDATE()) as days_left")->from("user_subscriptions")->where("user_id", $id)->order_by('user_subscriptions.id desc')->get();
                if ($subscription_rs->num_rows() > 0) {
                    $subscription = $subscription_rs->row();
                }
            } else {
                return L8_INSERT_ERROR;
            }
            // }
            if ($subscription->braintree_plan == L8_PLAN_PREMIUM_CTS) {
                $subscription->aircrafts = $this->GetSubscriptionAircrafts($subscription->id);
                $subscription->addons = $this->GetSubscriptionAddons($subscription->id);
            } else {
                $subscription->aircrafts = [];
                $subscription->addons = [];
            }
            if ($subscription->braintree_plan != L8_PLAN_BASIC && isset($subscription->trail_ends_at) && strtotime($subscription->trail_ends_at) >= time()) {
                $response = $this->braintree_lib->getSubscription($subscription->braintree_id);
                if (Braintree_Subscription::ACTIVE == $response["subscription"] || (Braintree_Subscription::CANCELED && strtotime($response["expires"]) > time())) {
                    return $subscription;
                }
            } else {
                return $subscription;
            }
        }
        return L8_INSERT_ERROR;
    }

    public function SetTempPlan($plan)
    {
        $this->session->set_userdata('tmp_plan', $plan);
    }

    public function GetPlan()
    {
        if ($this->input->post('plan') != '') {
            return $this->input->post('plan');
        } else if ($this->session->userdata('user_plan') != '') {
            return $this->session->userdata('user_plan');
        } else if ($this->session->userdata('tmp_plan') != '') {
            return $this->session->userdata('tmp_plan');
        } else {
            return L8_PLAN_BASIC;
        }
    }

    public function CalculateAmount($plan, $aircrfts = [], $subscribed = [])
    {
        $price = Plans($plan)["price"];
        $subscription_rs = $this->db->select("*, DATEDIFF(trial_ends_at, CURDATE()) as trial_left, DATEDIFF(ends_at, CURDATE()) as days_left")->from("user_subscriptions")->where("user_id", $this->session->userdata("user_id"))->order_by('user_subscriptions.id desc')->get();
        // if ($subscription_rs->num_rows() > 0) {
        $subscription = $subscription_rs->row();

        $aircraftCount = count($aircrfts) - count($subscribed);

        if ($plan == L8_PLAN_CTS || $plan == L8_PLAN_PREMIUM_CTS) {
            $price += $aircraftCount * L8_PLAN_CTS_EXTRA;
        }

        //   if (($subscription->trial_ends_at == null || $subscription->trial_ends_at == '' || strtotime($subscription->trial_ends_at) > time()) && $plan == L8_PLAN_PREMIUM_CTS) {
        //       $price = 0;
        //   }

        return $price;
        // } else {
        //   return 0;
        // }
    }

    public function CalculateCts()
    {
        $price = plans(L8_PLAN_CTS)["price"];
        $subscription = $this->Get($this->session->userdata("user_id"));
        if ($subscription != L8_INSERT_ERROR && ($subscription->braintree_plan == L8_PLAN_CTS || $subscription->braintree_plan == L8_PLAN_PREMIUM_CTS)) {
            $price = 0;
        }
        $aircrafts = 0;
        if ($this->input->get("aircrafts") == "") {
            $aircrafts = count(explode(",", $this->input->get("aircrafts")));
            if ($subscription != L8_INSERT_ERROR) {
                $aircrafts -= $subscription->nnumbers;
            }
        } else {
            $aircrafts = count(explode(",", $this->input->get("aircrafts")));
        }
        $price += $aircrafts * L8_PLAN_CTS_EXTRA;

        return $price;
    }

    public function GetSubscriptionAircrafts($id)
    {
        $results = [];
        $aircrafts = $this->db
            ->from("user_subscription_planes")
            ->where("subscription_id", $id)->get()->result_array();
        if (count($aircrafts) > 0) {
            foreach ($aircrafts as $aircraft) {
                $results[] = $aircraft["aircraft_id"];
            }
        }
        return $results;
    }

    public function GetSubscriptionAddons($id)
    {
        $results = [];
        $aircrafts = $this->db
            ->from("user_subscription_addons")
            ->where("subscription_id", $id)->get()->result_array();
        if (count($aircrafts) > 0) {
            foreach ($aircrafts as $aircraft) {
                $results[] = $aircraft["type"];
            }
        }
        return $results;
    }

    public function PostSubscriptionAddon($id)
    {
        if ($this->input->post("action") == "postAddons") {
            if (count($this->input->post("addon")) > 0) {
                foreach ($this->input->post("addon") as $addon) {
                    $this->SaveSubscriptionAddons($id, $addon);
                }
                push_message("Addons has been added successfully.");
            }
            redirect("flight-dispatch-board/create");
        }
    }

    public function SaveSubscriptionAddons($id, $addon)
    {
        $job["subscription_id"] = $id;
        $job["type"] = $addon;
        $job["price"] = plan_addons($addon)["amount"];
        $job["created"] = time();
        if ($this->db->insert("user_subscription_addons", $job)) {
            return $this->db->insert_id();
        } else {
            return L8_INSERT_ERROR;
        }
    }

    public function updateAircrafts($id, $aircrafts)
    {
        $this->db->where("subscription_id", $id)->delete("user_subscription_planes");
        foreach ($aircrafts as $aircraft) {
            $this->db->insert("user_subscription_planes", ["subscription_id" => $id, "aircraft_id" => $aircraft]);
        }
    }

    public function isTrialUser($id)
    {
        $subscription = $this->db->select("*, DATEDIFF(ends_at, CURDATE()) as days_left")->from("user_subscriptions")->where("user_id", $id)->order_by('user_subscriptions.id desc')->get()->row();
        return $subscription->braintree_id == '' && $subscription->braintree_plan == L8_PLAN_PREMIUM_CTS;
    }

    public function isTrialExpired($subscription)
    {
        if ($this->isTrialUser($subscription)) {
            return strtotime($subscription->trial_ends_at) <= time();
        }
        return true;
    }
}
