<?php 
/*
#Author: Cengkuru Micheal
9/25/14
1:14 PM
*/
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Faq_m extends MY_Model
{

    function __construct()
    {
        $this->load->model('user_m');
        $this->update_slugs();

    }
    public $_tablename='faqs';
    public  $_primary_key='id';

    //validate input
    public $validate_faq= array
    (

                array
                (
                    'field'   => 'qn',
                    'label'   => 'Question',
                    'rules'   => 'required|is_unique[faqs.qn]'
                ),


                array
                (
                    'field'   => 'details',
                    'label'   => 'Response',
                    'rules'   => 'required'
                ),

    );


    function get_faq_info($id='',$param='')
    {
        if($id=='')
        {
            return NULL;
        }
        else
        {
            $query=$this->db->select()->from($this->_tablename)->where('id',$id)->get();

            foreach($query->result_array()as $row)
            {
                switch($param)
                {
                    //case of title
                    case 'qn':
                        $result=$row['qn'];
                        break;
                    case 'ans':
                        $result=$row['ans'];
                        break;

                    case 'slug':
                        $result=$row['slug'];
                        break;


                    case 'dateadded':
                        $result=$row['dateadded'];
                        break;


                    case 'dateupdated':
                        $result=$row['dateupdated'];
                        break;

                    case 'trash':
                        $result=$row['trash'];
                        break;

                    case 'author':
                        $result=$this->user_m->get_user_info($row['author'],'fullname');
                        break;

                    default:
                        $result=$this->db->result_array();
                }
                return $result;
            }
        }
    }


        foreach($this->get_all()as $row)
        {
            if($row['slug']=='')
            {
                $data['slug']=strtolower(seo_url($row['qn']));
                $this->update($row['id'],$data);
            }
        }
    }
}

 