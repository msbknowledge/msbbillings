<?php
 class Pagination_model extends MY_Model { 
    //--- Get total record
     public function __construct() {
        parent::__construct();
         //$this->table_name = 'helps';
         $this->load->database('node_db', TRUE);
    }
   
function getcategorydatas($limit="",$offset=0,$search="",$tags = "",$categoryid="")
{

            $this->db->select('*');
            $this->db->from('blogs');
            if($search != '')
            {
                 $this->db->or_like('blog_title',$search);
                 $this->db->or_like('sort_content',$search);
            }
            if($tags != '')
            {
                $this->db->or_where('tags',$tags);
            }
            if($categoryid != '')
            {
                $this->db->or_where('blog_category_id',$categoryid);
            }
          if($limit != '' && $offset != '')
            {
                $this->db->limit($limit,$offset);
            }
             
            $query=$this->db->get();
            return $query->result();                   
        }
    function getcategorydata($limit="",$offset=0,$search="",$tags = "",$categoryid="")
    {

        $DB2 = $this->load->database('node_db', TRUE);
           $DB2->select('*');
           $DB2->from('blogs');
            if($search != '')
            {
                 $this->db->or_like('blog_title',$search);
                 $this->db->or_like('sort_content',$search);
            }
            if($tags != '')
            {
                $this->db->or_where('tags',$tags);
            }
            if($categoryid != '')
            {
                $this->db->or_where('blog_category_id',$categoryid);
            }
            if($limit != '' && $offset != '')
            {
                $this->db->limit($limit,$offset);
            }
           $query=$DB2->get();
           return $query->result();                   
        }
       
        function getTotalRow($search="",$tags ="",$categoryid="")
        {
           $DB2 = $this->load->database('node_db', TRUE);
           $DB2->select('*');
           $DB2->from('blogs');

            if($search != '')
            {
                $DB2->like('blog_title_hin',$search);
                $DB2->or_like('sort_content_hin',$search);
            }
            if($tags != '')
            {
              $DB2->where('tags_hin',$tags);
            }
            // if($categoryid  != '')
            // {
            //   $DB2->where('blog_category_id',$categoryid );
            // }
           
            
            $query =$DB2->get();
            $DB2->order_by("id", "desc");
            return $query->num_rows();

        }

           public function blogslug($blogslug)
        {     
             $DB2 = $this->load->database('node_db', TRUE);
          
            $DB2->where('slug',$blogslug);
            $query =$DB2->get('blogs');
            if($query->num_rows() > 0)
            {
              return $query->row()->id;
            }
            else
            {
              return false;
            }
        } 
     function taginenglish()
        {
            $DB2 = $this->load->database('node_db', TRUE);
             $DB2->select('DISTINCT(tags)');
             
             $DB2->from('blogs');
             $DB2->order_by("id", "desc");
             $DB2->limit('10');
            $query =  $DB2->get();
              
             return $query->result();    
        }
        public function getcatogryid($catname)
        {     
            $DB2 = $this->load->database('node_db', TRUE);
           $DB2->select('id');
           $DB2->where('name',$catname);
            $query =$DB2->get('blog_category');
            if($query->num_rows() > 0)
            {
              return $query->row();
            }
            else
            {
              return false;
            }
        } 
        

         public function getcatogryslug($catslug)
        {     
          $DB2 = $this->load->database('node_db', TRUE);
           $DB2->where('slug_hin',$catslug);
            $query =$DB2->get('blog_category')->row();
            if($query)
            {
              return  $query->id;
            }
            else
            {
              return false;
            }
        } 

        
        public function getImadeid($id)
        {
            $DB2 = $this->load->database('node_db', TRUE);
           $DB2->where('id', $id);
            $query =$DB2->get('blogs');
            if($query->num_rows() > 0)
            {
              return $query->row();
            }
            else
            {
              return false;
            }
        } 

      public function CountCategoryBlogs()
{
    $DB2 = $this->load->database('node_db', TRUE);

    $DB2->select('blog_category.name_hin as categories_hindi, blog_category.slug_hin as slug_hind, blog_category.id as categoryid, COUNT(blogs.id) as categories_count');
    $DB2->from('blog_category');
    $DB2->join('blogs', 'blog_category.id = blogs.blog_category_id AND blogs.status = "published"', 'left');
    $DB2->group_by('blog_category.id');
    $DB2->order_by('categories_count', 'desc');
    $DB2->limit(5);

    $query = $DB2->get();

    return $query->result_array();
}

        function savecommentdata($data)
        {       
            $DB2 = $this->load->database('node_db', TRUE);
               $res=$DB2->insert('blog_comment_hindi',$data);
               if ($res==1) 
               {
                return true;
               }
               else
               {
                return false;
               }
        }

       function fetchComment($id)
        {
            $DB2 = $this->load->database('node_db', TRUE);
               $DB2->select('*');    
               $DB2->from('blogs');
               $DB2->join('blog_comment_hindi','blogs.id = blog_comment_hindi.blog_id_hindi');
               $DB2->where('blog_id_hindi',$id);
                $DB2->limit('5');
                $query =$DB2->get();
                return $query->result();  
        }

        function countComment($id)
        {     
            $DB2 = $this->load->database('node_db', TRUE);
             $DB2->where('blog_id_hindi',$id);
              $query =$DB2->get('blog_comment_hindi');
              return  $query->num_rows();      
        }

       public function tagihindi()
{
    $DB2 = $this->load->database('node_db', TRUE);
    
    $DB2->select('DISTINCT(tags_hin)');
    $DB2->from('blogs');
    $DB2->order_by('id', 'desc'); // Corrected order_by syntax
    $DB2->limit(10);
    
    $query = $DB2->get(); // Assign the result of the query to $query

    return $query->result();
}


        function fechblogs()
        {
            $DB2 = $this->load->database('node_db', TRUE);
            $DB2->select('*');
           $DB2->from('blogs');
            $DB2->order_by("id desc");
            $DB2->limit('5');
             $query=$DB2->get();
             return $query->result();   
        }

       
        function countlike($id)
        {     
            $DB2 = $this->load->database('node_db', TRUE);
             $DB2->where('blog_id_hindi',$id);
              $query =$DB2->get('like');
              return  $query->num_rows();      
        }

        function savereply($data)
        {       
            $DB2 = $this->load->database('node_db', TRUE);
               $res=$DB2->insert('reply_hindi_blogs',$data);
               if ($res==1) 
               {
                return true;
               }
               else
               {
                return false;
               }
        }


      function fechreply($id)
      {
            
            $DB2 = $this->load->database('node_db', TRUE);
           
              $DB2->select('*');    
              $DB2->from('blogs');
               
              $DB2->join('reply_hindi_blogs','reply_hindi_blogs.blog_id_hindi=blogs.id');
              $DB2->where('reply_hindi_blogs.blog_id_hindi',$id);
               
              $DB2->limit('3');
                $query =$DB2->get();
                return $query->result();
      }



        function fechreplys($commentid)
        {
            $DB2 = $this->load->database('node_db', TRUE);
               $DB2->select('*');    
               $DB2->from('blog_comment_hindi');
               $DB2->join('reply_hindi_blogs','blog_comment_hindi.comnt_id  = reply_hindi_blogs.comment_id');
               $DB2->where('comment_id',$commentid);
               $DB2->limit('3');
                $query =$DB2->get();
                return $query->result();
        }

      
}
?>