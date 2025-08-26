<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Model_addendum extends CI_Model
{

    function browse()
    {
        $questions = array(
            array(
                "id" => 0,
                "question" => "Cover Letter",
                "type" => JOB_ANSWER_TYPE_WYSIWYG,
                "extra" => array(
                    array(
                        "id" => 1,
                        "question" => "When?",
                        "type" => JOB_ANSWER_TYPE_TEXT
                    ),
                ),
            ),

            array(
                "id" => 1,
                "question" => "Have you ever applied with our organization in the past?",
                "type" => JOB_ANSWER_TYPE_YES_NO,
                "extra" => array(
                    array(
                        "id" => 1,
                        "question" => "When?",
                        "type" => JOB_ANSWER_TYPE_TEXT
                    ),
                ),
            ),

            array(
                "id" => 3,
                "question" => "Have you ever interviewed with our organization in the past?",
                "type" => JOB_ANSWER_TYPE_YES_NO,
                "extra" => array(
                    array(
                        "id" => 4,
                        "question" => "When?",
                        "type" => JOB_ANSWER_TYPE_TEXT
                    ),
                ),
            ),

            array(
                "id" => 5,
                "question" => "Have you ever been employed within our organization in the past?",
                "type" => JOB_ANSWER_TYPE_YES_NO,
                "extra" => array(
                    array(
                        "id" => 6,
                        "question" => "When?",
                        "type" => JOB_ANSWER_TYPE_TEXT
                    ),
                    array(
                        "id" => 7,
                        "question" => "What Position?",
                        "type" => JOB_ANSWER_TYPE_TEXT
                    )
                ),
            ),

            array(
                "id" => 8,
                "question" => "Do you have an Internal Recommendation(s)?",
                "type" => JOB_ANSWER_TYPE_YES_NO,
                "extra" => array(
                    array(
                        "id" => 8,
                        "question" => "Enter employee's name(s)",
                        "type" => JOB_ANSWER_TYPE_TEXT
                    ),
                ),
            ),

            array(
                "header" => array(
                    "title" => "Criminal Background - Self Disclosure",
                    "description" => "The FAA requires all air carriers to complete a FBI criminal background check and fingerprinting on all prospective employees. The fingerprinting results will indicate any crime, whether it has been expunged, records have been sealed, or incident occurred when you were a minor."
                ),

                "id" => 9,
                "question" => "Have you ever had an arrest or conviction? (even if dismissed, expunged, or when you where a minor)",
                "type" => JOB_ANSWER_TYPE_YES_NO,
                "extra" => array(
                    array(
                        "id" => 10,
                        "question" => "Provide date?",
                        "type" => JOB_ANSWER_TYPE_TEXT
                    ),

                    array(
                        "id" => 11,
                        "question" => "Charge?",
                        "type" => JOB_ANSWER_TYPE_DATE
                    ),

                    array(
                        "id" => 13,
                        "question" => "Disposition?",
                        "type" => JOB_ANSWER_TYPE_TEXT
                    ),

                ),
            ),


            array(
                "note" => array(
                    "title" => "NOTE:",
                    "description" => "A conviction does not automatically mean that you will not be offered a job. The crime of which you were convicted, circumstances surrounding the conviction, and how long ago the conviction occurred are important. Please provide complete information so  an informed decision can be made."
                ),

                "header" => array(
                    "title" => "Department of Transportation - Self Disclosure:",
                    "description" => "The Department of Transportation (DOT) regulations requires pre-employment drug test, for safety-sensitive positions, which screens for marijuana, cocaine, phencyclamine (PCP), opiates and amphetamines or their metabolites."
                ),

                "id" => 14,
                "question" => "Have you held a safety sensitive job function subject to Department of Transportation drug and/or alcohol rules in the past five (5) years?",
                "type" => JOB_ANSWER_TYPE_YES_NO,
            ),

            array(
                "id" => 15,
                "question" => "Have you tested positive on or refused a Department of Transportation drug test in the past five (5) years?",
                "type" => JOB_ANSWER_TYPE_YES_NO,
            ),

            array(
                "id" => 16,
                "question" => "Have you tested positive and/or refused a Department of Transportation alcohol test in the past five (5) years?",
                "type" => JOB_ANSWER_TYPE_YES_NO,
            ),

            array(
                "id" => 17,
                "question" => "During the last two (2) years, have you tested positive or refused to test on any pre-employment drug or alcohol test administered by a Department of Transportation employer for a safety-sensitive position for which you applied but were not hired?",
                "type" => JOB_ANSWER_TYPE_YES_NO,
            ),


            array(
                "id" => 18,
                "question" => "Have you ever been Permanently Barred from the performance of safety-sensitive job functions by an employer under Federal Aviation Administration (FAA) drug/alcohol regulations?",
                "type" => JOB_ANSWER_TYPE_YES_NO,
            ),


            array(
                "header" => array(
                    "title" => "Driving History - Self Disclosure:",
                    "description" => ""
                ),
                "id" => 19,
                "question" => "Has your driver’s license ever been suspended?",
                "type" => JOB_ANSWER_TYPE_YES_NO,

                "extra" => array(
                    array(
                        "id" => 20,
                        "question" => "Please explain:",
                        "type" => JOB_ANSWER_TYPE_TEXT
                    ),

                    array(
                        "id" => 21,
                        "question" => "Including the nature:",
                        "type" => JOB_ANSWER_TYPE_TEXT
                    ),

                    array(
                        "id" => 22,
                        "question" => "Date?",
                        "type" => JOB_ANSWER_TYPE_DATE
                    ),

                    array(
                        "id" => 23,
                        "question" => "County:",
                        "type" => JOB_ANSWER_TYPE_TEXT
                    ),

                    array(
                        "id" => 24,
                        "question" => "State",
                        "type" => JOB_ANSWER_TYPE_TEXT
                    ),

                ),
            ),


            array(
                "id" => 25,
                "question" => "Have you been fined, plead guilty to, been convicted of, or been placed on probation for any moving traffic violations? (examples of moving traffic violations are, but not limited to: speeding, turn on red, running a red light, failure to yield, driving on a suspended license, careless driving, reckless driving, DUI/DWI, impaired driving, etc.)*",
                "type" => JOB_ANSWER_TYPE_YES_NO,

                "extra" => array(
                    array(
                        "id" => 26,
                        "question" => "Please explain:",
                        "type" => JOB_ANSWER_TYPE_TEXT
                    ),

                    array(
                        "id" => 27,
                        "question" => "Including the nature:",
                        "type" => JOB_ANSWER_TYPE_TEXT
                    ),

                    array(
                        "id" => 28,
                        "question" => "Date?",
                        "type" => JOB_ANSWER_TYPE_DATE
                    ),

                    array(
                        "id" => 29,
                        "question" => "County:",
                        "type" => JOB_ANSWER_TYPE_TEXT
                    ),

                    array(
                        "id" => 30,
                        "question" => "State of each violation",
                        "type" => JOB_ANSWER_TYPE_TEXT
                    ),

                    array(
                        "id" => 31,
                        "question" => "Any other pertinent information:",
                        "type" => JOB_ANSWER_TYPE_TEXT
                    ),
                ),
            ),

            array(
                "header" => array(
                    "title" => "FAA Record and Training Events - Self Disclosure",
                    "description" => ""
                ),

                "id" => 32,
                "question" => "Have you ever had, or been involved in, any aircraft accidents, incidents, or violations?",
                "type" => JOB_ANSWER_TYPE_YES_NO,
                "extra" => array(
                    array(
                        "id" => 33,
                        "question" => "Please explain:",
                        "type" => JOB_ANSWER_TYPE_TEXT
                    ),

                ),
            ),

            array(
                "id" => 34,
                "question" => "Have you ever been administered an FAA 709 checkride?",
                "type" => JOB_ANSWER_TYPE_YES_NO,
                "extra" => array(
                    array(
                        "id" => 35,
                        "question" => "Please explain:",
                        "type" => JOB_ANSWER_TYPE_TEXT
                    ),

                ),
            ),


            array(
                "id" => 36,
                "question" => "Have you ever failed to complete Initial, Transition, or an Upgrade course of training under FAR Part 121 or FAR Part 135?",
                "type" => JOB_ANSWER_TYPE_YES_NO,
                "extra" => array(
                    array(
                        "id" => 37,
                        "question" => "Please explain:",
                        "type" => JOB_ANSWER_TYPE_TEXT
                    ),

                ),
            ),


            array(
                "id" => 38,
                "question" => "Have you ever failed a checkride? (include all initial, recurrent, upgrade, transition, proficiency, line checks, rating check rides, Part 141/142 stage/phase checks, any orals, and any military checkrides)",
                "type" => JOB_ANSWER_TYPE_YES_NO,
            ),

        );

        return $questions;
    }

    function get($id)
    {
        $id = base64_decode(urldecode($id));
        return $this->db
            ->from("application_addendum")
            ->where("application_id", $id)
            ->get()
            ->row_array();
    }

    function post($application_id)
    {

        for ($i = 0; $i < 39; $i++) {
            $this->form_validation->set_rules($i, 'This Question', 'required');
        }

        if ($this->form_validation->run() == FALSE) {
            return ["status" => "error", "messages" => validation_errors()];

        } else {


            for ($i = 0; $i < 39; $i++) {
                $data = array(
                    "application_id" => $application_id,
                    "question_id" => $i,
                    "answer" => $this->input->post($i),
                    "created" => time()
                );
                if ($this->input->post('id') == '') {
                    $this->db->insert('application_addendum', $data);
                } else {
                    $this->db->where('application_id', $application_id);
                    $this->db->where('question_id', $i);
                    $this->db->update('application_addendum', $data);
                }
            }

            return ["status" => "success"];

        }
    }

    public function delete($id)
    {
        $this->db->delete('application_addendum', array('application_id' => $id));
        return ["status" => "success"];
    }
}