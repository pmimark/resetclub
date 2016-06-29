<?php 
/************************************************************************************** 
* Class: Pager 
* Author: Tsigo <tsigo@tsiris.com> 
* Methods: 
*         findStart 
*         findPages 
*         pageList 
*         nextPrev 
* Redistribute as you see fit. 
**************************************************************************************/ 
class Pager 
  { 
  /*********************************************************************************** 
   * int findStart (int limit) 
   * Returns the start offset based on $_GET['page'] and $limit 
   ***********************************************************************************/ 
   function findStart($limit) 
    { 
     if ((!isset($_GET['pg'])) || ($_GET['pg'] == "1")) 
      { 
       $start = 0; 
       $_GET['pg'] = 1; 
      } 
     else 
      { 
       $start = ($_GET['pg']-1) * $limit; 
      } 

     return $start; 
    } 
  /*********************************************************************************** 
   * int findPages (int count, int limit) 
   * Returns the number of pages needed based on a count and a limit 
   ***********************************************************************************/ 
   function findPages($count, $limit) 
    { 
     $pages = (($count % $limit) == 0) ? $count / $limit : floor($count / $limit) + 1; 

     return $pages; 
    } 
  /*********************************************************************************** 
   * string pageList (int curpage, int pages) 
   * Returns a list of pages in the format of "« < [pages] > »" 
   ***********************************************************************************/ 
   function pageList($curpage, $pages) 
    { 
     $page_list  = ""; 

     /* Print the first and previous page links if necessary */ 
     if (($curpage != 1) && ($curpage)) 
      { 
       $page_list .= "  <a href=\"".$_SERVER['PHP_SELF']."?page=manage_image&pg=1\" title=\"First Page\">&laquo; &nbsp;</a> "; 
      } 

     if (($curpage-1) > 0) 
      { 
       $page_list .= "<a href=\"".$_SERVER['PHP_SELF']."?page=manage_image&pg=".($curpage-1)."\" title=\"Previous Page\"><</a> "; 
      } 

     /* Print the numeric page list; make the current page unlinked and bold */ 
     for ($i=1; $i<=$pages; $i++) 
	
       { 
       if ($i == $curpage) 
        { 
         $page_list .= "<b>".$i."</b>"; 
        } 
       else 
        { 
         $page_list .= "<a href=\"".$_SERVER['PHP_SELF']."?page=manage_image&pg=".$i."\" title=\"Page ".$i."\">&nbsp;".$i."&nbsp;</a>"; 
        } 
       $page_list .= " "; 
      } 

     /* Print the Next and Last page links if necessary */ 
     if (($curpage+1) <= $pages) 
      { 
       $page_list .= "<a href=\"".$_SERVER['PHP_SELF']."?page=manage_image&pg=".($curpage+1)."\" title=\"Next Page\">&nbsp;&gt;</a> "; 
      } 

     if (($curpage != $pages) && ($pages != 0)) 
      { 
       $page_list .= "<a href=\"".$_SERVER['PHP_SELF']."?page=manage_image&pg=".$pages."\" title=\"Last Page\">&nbsp;&raquo;</a> "; 
      } 
     $page_list .= "</td>\n"; 

     return $page_list; 
    } 
  /*********************************************************************************** 
   * string nextPrev (int curpage, int pages) 
   * Returns "Previous | Next" string for individual pagination (it's a word!) 
   ***********************************************************************************/ 
   function nextPrev($curpage, $pages) 
    { 
     $next_prev  = ""; 

     if (($curpage-1) <= 0) 
      { 
       $next_prev .= "Previous"; 
      } 
     else 
      { 
       $next_prev .= "<a href=\"".$_SERVER['PHP_SELF']."?page=manage_image&pg=".($curpage-1)."\">&nbsp;&lt;&lt;</a>"; 
      } 

     $next_prev .= " | "; 

     if (($curpage+1) > $pages) 
      { 
       $next_prev .= "Next"; 
      } 
     else 
      { 
       $next_prev .= "<a href=\"".$_SERVER['PHP_SELF']."?page=manage_image&pg=".($curpage+1)."\">&lt;&nbsp;</a>"; 
      } 

     return $next_prev; 
    } 
  } 
?> 