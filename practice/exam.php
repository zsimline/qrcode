<?php
  require_once '../lib/user.lib.php';
  require_once '../lib/cookie.lib.php';
  require_once '../lib/item.lib.php';

  $user = new User();
  $db_choose = new Moudle();
  $db_jump = new Moudle();
  $cookieman = new CookieMan();

  if(!$cookieman->getLoginState()){
      echo "<script type='text/javascript'>alert('请先登录系统');window.location.href='/DrivingTest/user/login.php'</script>";
      return ;
  }

  if(isset($_GET['subject'])){
      $subject = $_GET['subject'];
      $item = new Item($subject);
  }
  else return ;
  
  $itemids = "";  // 存放试卷中题目ID 
  
  $i = 0;
  $j = 0;
  
  /* 从数据库组题  */
  $statement_choose = "select * from subject$subject where genre='C' order by rand() limit 70";
  $statement_jump = "select * from subject$subject where genre='J' order by rand() limit 30";
  
  $result_choose = $db_choose->executeQuery($statement_choose);
  $result_jump = $db_jump->executeQuery($statement_jump);
  
?>

<!DOCTYPE HTML>
<html>
  
  <head>
    <meta charset="UTF-8">
    <title>在线模拟考试</title>
    <link rel="stylesheet" type="text/css" href="../resources/css/exam.view.css" />
    <style>.hasBeenAnswer { background: #5d9cec; color:#fff; }</style></head>
  
  <body>
    <div class="main">
      <div class="test_main">
        <div class="nr_left">
          <div class="test">
            <form action="exec/markpapers.php?subject=1" method="post">
              <div class="test_title">
                <span>
                  <input type="submit" name="test_jiaojuan" value="交卷" id="submit"></span>
              </div>
              <div class="test_content">
                <div class="test_content_title">
                  <h2>单选题</h2>
                  <p>
                    <span>共</span>
                    <i class="content_lit">70</i>
                    <span>题，</span>
                    <span>合计</span>
                    <i class="content_fs">70</i>
                    <span>分</span></p>
                </div>
              </div>
              <div class="test_content_nr">
                <ul>
				  <?php while($res_choose = $result_choose->fetch(PDO::FETCH_ASSOC)){ ?>
                  <!-- 单选题开始 -->
                  <li id="qu_0_<?php echo $i ?>">
                    <div class="test_content_nr_tt">
                      <i><?php echo $i+1 ?></i>
                      <span>(1分)</span>
                      <span><?php echo $res_choose['question'] ?></span></div>
                    <div class="test_content_nr_main">
                      <ul>
                        <li class="option">
                          <input type="radio" class="radioOrCheck" name="answer<?php echo $i ?>" id="0_answer_<?php echo $i ?>_option_1" value="A"/>
                          <label for="0_answer_<?php echo $i ?>_option_1">A.
                            <p class="ue" style="display: inline;"><?php echo $res_choose['rA']?></p></label>
                        </li>
                        <li class="option">
                          <input type="radio" class="radioOrCheck" name="answer<?php echo $i ?>" id="0_answer_<?php echo $i ?>_option_2" value="B"/>
                          <label for="0_answer_<?php echo $i ?>_option_2">B.
                            <p class="ue" style="display: inline;"><?php echo $res_choose['rB']?></p></label>
                        </li>
                        <li class="option">
                          <input type="radio" class="radioOrCheck" name="answer<?php echo $i ?>" id="0_answer_<?php echo $i ?>_option_3" value="C"/>
                          <label for="0_answer_<?php echo $i ?>_option_3">C.
                            <p class="ue" style="display: inline;"><?php echo $res_choose['rC']?></p></label>
                        </li>
                        <li class="option">
                          <input type="radio" class="radioOrCheck" name="answer<?php echo $i ?>" id="0_answer_<?php echo $i ?>_option_4" value="D"/>
                          <label for="0_answer_<?php echo $i ?>_option_4">D.
                            <p class="ue" style="display: inline;"><?php echo $res_choose['rD']?></p></label>
                        </li>
                      </ul>
                    </div>
                  </li>
				  <?php $i++; $itemids = $itemids.$res_choose['id'].'-'; } ?>
                </ul>
              </div>
              <div class="test_content">
                <div class="test_content_title">
                  <h2>判断题</h2>
                  <p>
                    <span>共</span>
                    <i class="content_lit">30</i>
                    <span>题，</span>
                    <span>合计</span>
                    <i class="content_fs">30</i>
                    <span>分</span></p>
                </div>
              </div>
              <div class="test_content_nr">
                <ul>
                  <?php while($res_jump = $result_jump->fetch(PDO::FETCH_ASSOC)){ ?>
                  <!-- 判断题开始 -->
                  <li id="qu_1_<?php echo $j ?>">
                    <div class="test_content_nr_tt">
                      <i><?php echo $j+71 ?></i>
                      <span>(1分)</span>
                      <span><?php echo $res_jump['question']?></span></div>
                    <div class="test_content_nr_main">
                      <ul>
                        <li class="option">
                          <input type="radio" class="radioOrCheck" name="answer<?php echo $j+70 ?>" id="1_answer_<?php echo $j ?>_option_1" value="T"/>
                          <label for="1_answer_<?php echo $j ?>_option_1">A.
                            <p class="ue" style="display: inline;">正确</p></label>
                        </li>
                        <li class="option">
                          <input type="radio" class="radioOrCheck" name="answer<?php echo $j+69 ?>" id="1_answer_<?php echo $j ?>_option_2" value="F"/>
                          <label for="1_answer_<?php echo $j ?>_option_2">B.
                            <p class="ue" style="display: inline;">错误</p></label>
                        </li>
                      </ul>
                    </div>
                  </li>
				  <?php $j++; $itemids = $itemids.$res_jump['id'].'-'; } ?>
                </ul>
              </div>
            </form>
          </div>
        </div>
        <div class="nr_right">
          <div class="nr_rt_main">
            <div class="rt_nr1">
              <div class="rt_nr1_title">
                <h1>答题卡</h1>
                <p class="test_time">
                  <b class="alt-1">01:40</b></p>
              </div>
              <div class="rt_content">
                <div class="rt_content_nr answerSheet">
                  <ul>
                    <li>
                      <a href="#qu_0_0">1</a></li>
                    <li>
                      <a href="#qu_0_1">2</a></li>
                    <li>
                      <a href="#qu_0_2">3</a></li>
                    <li>
                      <a href="#qu_0_3">4</a></li>
                    <li>
                      <a href="#qu_0_4">5</a></li>
                    <li>
                      <a href="#qu_0_5">6</a></li>
                    <li>
                      <a href="#qu_0_6">7</a></li>
                    <li>
                      <a href="#qu_0_7">8</a></li>
                    <li>
                      <a href="#qu_0_8">9</a></li>
                    <li>
                      <a href="#qu_0_9">10</a></li>
                    <li>
                      <a href="#qu_0_10">11</a></li>
                    <li>
                      <a href="#qu_0_11">12</a></li>
                    <li>
                      <a href="#qu_0_12">13</a></li>
                    <li>
                      <a href="#qu_0_13">14</a></li>
                    <li>
                      <a href="#qu_0_14">15</a></li>
                    <li>
                      <a href="#qu_0_15">16</a></li>
                    <li>
                      <a href="#qu_0_16">17</a></li>
                    <li>
                      <a href="#qu_0_17">18</a></li>
                    <li>
                      <a href="#qu_0_18">19</a></li>
                    <li>
                      <a href="#qu_0_19">20</a></li>
                    <li>
                      <a href="#qu_0_20">21</a></li>
                    <li>
                      <a href="#qu_0_21">22</a></li>
                    <li>
                      <a href="#qu_0_22">23</a></li>
                    <li>
                      <a href="#qu_0_23">24</a></li>
                    <li>
                      <a href="#qu_0_24">25</a></li>
                    <li>
                      <a href="#qu_0_25">26</a></li>
                    <li>
                      <a href="#qu_0_26">27</a></li>
                    <li>
                      <a href="#qu_0_27">28</a></li>
                    <li>
                      <a href="#qu_0_28">29</a></li>
                    <li>
                      <a href="#qu_0_29">30</a></li>
                    <li>
                      <a href="#qu_0_30">31</a></li>
                    <li>
                      <a href="#qu_0_31">32</a></li>
                    <li>
                      <a href="#qu_0_32">33</a></li>
                    <li>
                      <a href="#qu_0_33">34</a></li>
                    <li>
                      <a href="#qu_0_34">35</a></li>
                    <li>
                      <a href="#qu_0_35">36</a></li>
                    <li>
                      <a href="#qu_0_36">37</a></li>
                    <li>
                      <a href="#qu_0_37">38</a></li>
                    <li>
                      <a href="#qu_0_38">39</a></li>
                    <li>
                      <a href="#qu_0_39">40</a></li>
                    <li>
                      <a href="#qu_0_40">41</a></li>
                    <li>
                      <a href="#qu_0_41">42</a></li>
                    <li>
                      <a href="#qu_0_42">43</a></li>
                    <li>
                      <a href="#qu_0_43">44</a></li>
                    <li>
                      <a href="#qu_0_44">45</a></li>
                    <li>
                      <a href="#qu_0_45">46</a></li>
                    <li>
                      <a href="#qu_0_46">47</a></li>
                    <li>
                      <a href="#qu_0_47">48</a></li>
                    <li>
                      <a href="#qu_0_48">49</a></li>
                    <li>
                      <a href="#qu_0_49">50</a></li>
                    <li>
                      <a href="#qu_0_50">51</a></li>
                    <li>
                      <a href="#qu_0_51">52</a></li>
                    <li>
                      <a href="#qu_0_52">53</a></li>
                    <li>
                      <a href="#qu_0_53">54</a></li>
                    <li>
                      <a href="#qu_0_54">55</a></li>
                    <li>
                      <a href="#qu_0_55">56</a></li>
                    <li>
                      <a href="#qu_0_56">57</a></li>
                    <li>
                      <a href="#qu_0_57">58</a></li>
                    <li>
                      <a href="#qu_0_58">59</a></li>
                    <li>
                      <a href="#qu_0_59">60</a></li>
                    <li>
                      <a href="#qu_0_60">61</a></li>
                    <li>
                      <a href="#qu_0_61">62</a></li>
                    <li>
                      <a href="#qu_0_62">63</a></li>
                    <li>
                      <a href="#qu_0_63">64</a></li>
                    <li>
                      <a href="#qu_0_64">65</a></li>
                    <li>
                      <a href="#qu_0_65">66</a></li>
                    <li>
                      <a href="#qu_0_66">67</a></li>
                    <li>
                      <a href="#qu_0_67">68</a></li>
                    <li>
                      <a href="#qu_0_68">69</a></li>
                    <li>
                      <a href="#qu_0_69">70</a></li>
                    <li>
                      <a href="#qu_1_0">71</a></li>
                    <li>
                      <a href="#qu_1_1">72</a></li>
                    <li>
                      <a href="#qu_1_2">73</a></li>
                    <li>
                      <a href="#qu_1_3">74</a></li>
                    <li>
                      <a href="#qu_1_4">75</a></li>
                    <li>
                      <a href="#qu_1_5">76</a></li>
                    <li>
                      <a href="#qu_1_6">77</a></li>
                    <li>
                      <a href="#qu_1_7">78</a></li>
                    <li>
                      <a href="#qu_1_8">79</a></li>
                    <li>
                      <a href="#qu_1_9">80</a></li>
                    <li>
                      <a href="#qu_1_10">81</a></li>
                    <li>
                      <a href="#qu_1_11">82</a></li>
                    <li>
                      <a href="#qu_1_12">83</a></li>
                    <li>
                      <a href="#qu_1_13">84</a></li>
                    <li>
                      <a href="#qu_1_14">85</a></li>
                    <li>
                      <a href="#qu_1_15">86</a></li>
                    <li>
                      <a href="#qu_1_16">87</a></li>
                    <li>
                      <a href="#qu_1_17">88</a></li>
                    <li>
                      <a href="#qu_1_18">89</a></li>
                    <li>
                      <a href="#qu_1_19">90</a></li>
                    <li>
                      <a href="#qu_1_20">91</a></li>
                    <li>
                      <a href="#qu_1_21">92</a></li>
                    <li>
                      <a href="#qu_1_22">93</a></li>
                    <li>
                      <a href="#qu_1_23">94</a></li>
                    <li>
                      <a href="#qu_1_24">95</a></li>
                    <li>
                      <a href="#qu_1_25">96</a></li>
                    <li>
                      <a href="#qu_1_26">97</a></li>
                    <li>
                      <a href="#qu_1_27">98</a></li>
                    <li>
                      <a href="#qu_1_28">99</a></li>
                    <li>
                      <a href="#qu_1_29">100</a></li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="foot"></div>
    </div>
    
    <script src="../resources/js/jquery-1.11.3.min.js"></script>
    <script src="../resources/js/jquery.easy-pie-chart.js"></script>
    
    <!--时间js-->
    <script src="../resources/js/jquery.countdown.js"></script>
    <script>window.jQuery(function($) {
        "use strict";

        $('time').countDown({
          with_separators: false
        });
        $('.alt-1').countDown({
          css_class: 'countdown-alt-1'
        });
        $('.alt-2').countDown({
          css_class: 'countdown-alt-2'
        });

      });

      $(function() {
        $('li.option label').click(function() {
          var examId = $(this).closest('.test_content_nr_main').closest('li').attr('id'); // 得到题目ID
          var cardLi = $('a[href=#' + examId + ']'); // 根据题目ID找到对应答题卡
          // 设置已答题
          if (!cardLi.hasClass('hasBeenAnswer')) {
            cardLi.addClass('hasBeenAnswer');
          }

        });
      });</script>
  
  </body>

</html>


<?php 
    $db = new Moudle();
    date_default_timezone_set("Asia/Shanghai");  // 设置时区
    $statement = "insert into examinfo (subject,userid,examTime,itemids) values ('".$subject."','".$_COOKIE['userid']."','".date("Y-m-d H:i:s")."','".$itemids."')";
    $db->executeUpdate($statement);
?>