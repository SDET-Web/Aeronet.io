<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Model_cache extends CI_Model{

	public function build_article_cache_gmreader($body,$id){
        $this->build_single($body,$id);
        /*$ref_count = 0;
        $refences = '';
        preg_match_all("/<a.*?href=\"([^`]*?)\".*?>([^`]*?)<\/a>/",$body,$ar);
        $a_tag = $ar[0];
        $a_href = $ar[1];
        $a_title = $ar[2];
        $a_temp = '';
        $count = 1;
        for($i = 0; $i < count($a_tag);$i++){
            $txt = str_replace('&#38;','&amp;',str_replace('’', "'", $a_title[$i]));
            $txt = htmlentities($txt);
            //$a_href[$i] = str_replace('/reference/link/', '', $a_href[$i]);
            if(strpos($a_href[$i], '#')===FALSE){
                if(strpos($a_href[$i], '/reference/link/')===FALSE){
                    $link_text = $this->db->from('xenon_link_gmreader')->join('xenon_data','xenon_link_gmreader.data_id = xenon_data.data_id')->where('link_id',base64_decode(urldecode($a_href[$i])))->get();
                    if($link_text->num_rows() > 0){
                        $tmp_row = $link_text->row();
                        $a_temp = '<a href="'.$tmp_row->data_id.'">'.$tmp_row->data_title.'</a>';
                    }else{
                        $a_temp = '<span>'.$txt.'</span>';
                    }
                }else{
                    $link_text = $this->db->from('xenon_link_gmreader')->join('xenon_reference','xenon_link_gmreader.data_id = xenon_reference.refe_id')->where('link_id',base64_decode(urldecode(str_replace('/reference/link/', '',$a_href[$i]))))->get();
                    if($link_text->num_rows() > 0){
                        $tmp_row = $link_text->row();
                        $a_temp = '<a href="'.$tmp_row->refe_id.'" class="reference-transfer" id="'.$count.'">'. $tmp_row->refe_title.'</a>';
                        $count = $count + 1;
                    }else{
                        $a_temp = '<span>'.$txt.'</span>';
                    }
                }
                $body = str_replace($a_tag[$i], $a_temp, $body);//'<a href="'.$link_new.'" class="reference"><pre>'.$txt.'</pre></a>', $body);

            }
        }
        $dom = new DOMDocument();
        $dom->loadHTML($body);
        //echo $dom->saveHTML();
        $data['data_body_cache_gmreader'] = substr($dom->saveHTML(),119,-15).($refences!=''?'<div class="ref-container"><h2 class="ref-head">References</h2>'.$refences.'</div>':'');
        $this->db->where('data_id',$id);
        $this->db->update('xenon_data',$data);*/
	}

    function link_validator($href, $data_id){
        $link = $this->db->from('xenon_link_gmreader')->where('link_id',$href)->get();
        if($link->num_rows() > 0){
            $link_data = $this->db->from('xenon_data_links_gmreader')->where('link_id',$href)->where('data_id',$data_id)->get();
            if($link_data->num_rows() <= 0){
                $this->db->insert('xenon_data_links_gmreader',array(
                    'link_id'   => $href,
                    'data_id'   => $data_id,
                    'status'    => 'y'
                ));
                return true;
            }else if($link_data->row()->status == 'y'){
                return true;
            }else if($link_data->row()->status == 'n'){
                return false;
            }
        }else{
            return false;
        }
    }

    function link_extractor($title, $link_id, $count){
        $title = str_replace('&#38;','&amp;',str_replace('’', "'", $title));
        $title = htmlentities($title);
        $link = array('reference'=>'','anchor');
        if($title == 'references'){
            $link_text = $this->db->from('xenon_link_gmreader')->join('xenon_reference','xenon_link_gmreader.data_id = xenon_reference.refe_id')->where('link_id',$link_id)->get();
            if($link_text->num_rows() > 0){
                $count = $count + 1;
                $link['reference'] = '<div><a href="'.$link_text->row()->refe_id.'" class="reference-transfer" id="'.$count.'">'.$count.'. '.$link_text->row()->refe_title.'</a></div>';
                $link['anchor'] = '<a href="'.'#'.$count.'" class="reference"><span class="pre">'.'['.$count.']'.'</span></a>';
            }else{
                $link['anchor'] = '';
            }
        }else{
            $link_text = $this->db->from('xenon_link_gmreader')->join('xenon_data','xenon_link_gmreader.data_id = xenon_data.data_id')->where('link_id',$link_id)->get();
            if($link_text->num_rows() > 0){
                $link['anchor'] = '<a href="'.$link_text->row()->data_id.'" class="data">'.$link_text->row()->data_title.'</a>';
            }else{
                $link['anchor'] = '';
            }
        }
        return array_merge($link,array('count'=>$count));
    }

	function build_single($body,$id){
		$ref_count = 0;
		$refences = '';
		preg_match_all("/<a.*?href=\"([^`]*?)\">([^`]*?)<\/a>/",$body,$ar);
		$a_tag = $ar[0];
		$a_href = $ar[1];
		$a_title = $ar[2];

        for($i = 0; $i < count($a_tag);$i++){
            if($this->link_validator(base64_decode(urldecode($a_href[$i])),$id)){
                $link = $this->link_extractor($a_title[$i],base64_decode(urldecode($a_href[$i])),$ref_count);
                $body = str_replace($a_tag[$i], $link['anchor'], $body);
                $refences .= $link['reference'];
                $ref_count = $link['count'];
            }else{
                $body = str_replace($a_tag[$i], $a_title[$i], $body);
            }
        }

		$dom = new DOMDocument();
		$dom->loadHTML($body);
		$data['data_body_cache_gmreader'] = substr($dom->saveHTML(),119,-15).($refences!=''?'<div class="ref-container"><h2 class="ref-head">References</h2>'.$refences.'</div>':'');
		$this->db->where('data_id',$id);
		$this->db->update('xenon_data',$data);
	}
}
?>