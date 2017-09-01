<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//dw 域名质押
Route::get("/domain","Home\BorrowController@domain");
//dw 域名质押入库
Route::match(['get','post'],"/domain_do","Home\BorrowController@domain_do");
//dw 域名展示
Route::get("/domain_index","Home\BorrowController@domain_index");
//dw 域名后台审核
Route::get("/admin_domain","Admin\BorrowController@domain");
//dw域名审核入库
Route::match(['get','post'],"/admin_domain_do","Admin\BorrowController@domain_do");
//dw 我要借款
Route::any("/borrow_insert","Home\BorrowController@borrow_insert");
//dw 借款入库
Route::match(['get','post'],"/borrow_bor","Home\BorrowController@borrow_bor");
//dw 借款后台审核
Route::get("/admin_bor","Admin\BorrowController@admin_bor");
//dw 借款后台审核
Route::get("/admin_bor_info","Admin\BorrowController@admin_bor_info");
//dw 后台审核成功
Route::match(['get','post'],"/admin_bor_su","Admin\BorrowController@admin_bor_su");
//dw 借款展示
Route::match(['get','post'],"/borrow_list_data","Home\BorrowController@borrow_list_data");

//出借转让模块son
Route::any('/can_transfer_data','Home\TransferController@can_transfer_data');
Route::any('/in_transfer_data','Home\TransferController@in_transfer_data');
Route::any('/complate_transfer_data','Home\TransferController@complate_transfer_data');
Route::any('/fail_transfer_data','Home\TransferController@fail_transfer_data');
//回款计划son
Route::any('/recover_list_data','Home\RecoverController@recover_list_data');
//借款管理son
//域名管理son
Route::any('/pawn_list_data','Home\PawnController@pawn_list_data');
//投资记录
Route::match(['get','post'],'/tender_list_data','Home\TenderController@tender_list_data');
//还款
Route::any('/refund_list_data','Home\RefundController@refund_list_data');
//邀请注册
Route::any('/invite_list_data','Home\InviteController@invite_list_data');
//邀请注册三
Route::any('/award_list_data','Home\AwardController@award_list_data');
//银行卡模块
Route::any('/bank_info','Home\BankController@index');
//解绑银行卡
Route::any('/unbinding_bank_card','Home\BankController@unbinding_bank_card');
//查询银行卡
Route::any('/get_bank_info','Home\BankController@get_bank_info');

Route::any('/binding_bank_card_advance','Home\BankController@binding_bank_card_advance');
//绑定银行卡
Route::any('/binding_bank_card','Home\BankController@binding_bank_card');
//修改手机号码
Route::any('/change_phone','Home\SafeController@change_phone');
//添加邮箱
Route::match(['get','post'],'/add_email','Home\SafeController@add_email');
//确定邮箱
Route::match(['get','post'],'/activate','Home\SafeController@activate');
//出借模块
//还款计划
Route::any('/refund_list','Home\User_infoController@refund_list');
//出借记录
Route::any('/tender_list','Home\User_infoController@tender_list');
//回款计划
Route::any('/recover','Home\User_infoController@recover_list');
//出借转让
Route::any('/transfer','Home\User_infoController@transfer_list');
//借款
Route::any('/borrow_list','Home\User_infoController@borrow_list');
//域名管理
Route::any('/pawn_list','Home\User_infoController@pawn_list');
//申请质押
Route::any('/pawn','Home\User_infoController@pawn');
//邀请注册
Route::any('/invite_one','Home\User_infoController@invite');
//邀请注册二
Route::any('/invite_list','Home\User_infoController@invite_list');
//邀请注册三
Route::any('/award_list','Home\User_infoController@award_list');

//资金充值统计
Route::get('/fund_statistic','Home\RechargeController@fundlist');
//支付宝支付
Route::match(['get','post'],'/alipay/pay','Home\AlipayController@pay');
Route::match(['get','post'],'/alipay/notify','Home\AlipayController@aliPayNotify'); //服务器异步通知页面路径
Route::get('/alipay/return','Home\AlipayController@aliPayReturn');
Route::get('/alipay/fail','Home\AlipayController@pay_fail');
Route::get('/success','Home\AlipayController@pay_success');
//微信回调
Route::any('/wechat/return', 'Home\AlipayController@wechatreturn');
//微信订单查询
Route::any('/wechat/orderquery', 'Home\AlipayController@orderquery');
// 前台首页
Route::get('/','Home\IndexController@index');
//获取首页新闻
Route::get('/home_index_new','Home\IndexController@home_index_new');
//提现操作
Route::any('/withdraw', 'Home\RechargeController@withdraw');
//第三方登录
Route::get('/auth/{service}', 'Home\LoginController@redirectToProvider');
//第三方回调
Route::get('/{service}/callback', 'Home\LoginController@handleProviderCallback');
//第三方回调登录
Route::match(['get','post'],'/oauth_reg','Home\LoginController@oauth_reg');
//短信
Route::match(['get','post'],'/client','Home\LoginController@client');
// 第三方绑定
Route::match(['get','post'],'/oauth_bind','Home\LoginController@oauth_bind');
//登录
Route::match(['get','post'],'/login','Home\LoginController@index');
//退出
Route::get('/logout','Home\LoginController@logout');
//验证码
Route::get('/captcha/{tmp}','Home\LoginController@captcha');
//我要出借
Route::get('/invest','Home\InvestController@index');
//注册
Route::match(['get','post'],'/register','Home\RegisterController@index');
//注册第二步
Route::match(['get','post'],'/register_tel','Home\Register_telController@index');
//注册第三步
Route::get('/register_success','Home\Register_telController@register_success');
//用户安全中心
Route::get('/user_safe','Home\SafeController@user_safe');
//安全中心实名认证
Route::match(['get','post'],'/user_card_add','Home\SafeController@user_card_add');
//安全中心支付密码
Route::match(['get','post'],'/user_pay_pwd','Home\SafeController@user_pay_pwd');
//修改安全中心支付密码
Route::match(['get','post'],'/upload_pay_pwd','Home\SafeController@upload_pay_pwd');
//个人中心充值
Route::match(['get','post'],'/recharge','Home\RechargeController@index');
//修改用户登录密码
Route::match(['get','post'],'/upload_login_pwd','Home\SafeController@upload_login_pwd');
//我要借款
Route::get('/borrow','Home\BorrowController@index');
//借款中心
Route::get('/borrow_add','Home\BorrowController@add');
//借款管理
Route::match(['get','post'],'/borrow_ajax','Home\BorrowController@ajax');
//我要借款
Route::get('/borrow_news','Home\BorrowController@news');
//借款审核入库
Route::match(['get','post'],'/borrow_do','Home\BorrowController@news_do');
//安全中心
Route::get('/safe','Home\SafeController@index');
//用户中心
Route::get('/user_info','Home\User_infoController@index');


//后台首页
Route::get('/admin_index','Admin\IndexController@index');
//后台登录
Route::get('/admin_login','Admin\LoginController@index');
//后台修改密码
Route::get('/admin_pass','Admin\PassController@index');
//后台单页信息
Route::get('/admin_page','Admin\PageController@index');
//后台内容管理
Route::get('/admin_column','Admin\ColumnController@index');
//后台文章管理
Route::get('/admin_article','Admin\ArticleController@index');
//后台文章添加
Route::get('/admin_article_add','Admin\ArticleController@add');
//后台文章添加入库
Route::post('/admin_article_add_do','Admin\ArticleController@add_do');
//后台文章修改
Route::get('/admin_article_update','Admin\ArticleController@update');
//后台文章修改入库
Route::match(['get','post'],'/admin_article_update_do','Admin\ArticleController@update_do');
//后台文章删除
Route::get('/admin_article_delete/{id}','Admin\ArticleController@delete');

//后台积分抽奖
Route::get('/admin_lottery','Admin\LotteryController@index');
//后台添加活动
Route::get('/admin_lottery_add','Admin\LotteryController@add');
//后台活动入库
Route::match(['get','post'],'/admin_lottery_adds','Admin\LotteryController@add_do');
//后台活动修改状态
Route::get('/admin_lottery_up','Admin\LotteryController@up');
//后台活动删除
Route::get('/admin_lottery_del','Admin\LotteryController@del');
//后台活动修改
Route::get('/admin_lottery_update','Admin\LotteryController@update');
//后台活动修改库
Route::match(['get','post'],'/admin_lottery_updates','Admin\LotteryController@update_do');

//前台积分抽奖
Route::get('/lottery','Home\LotteryController@index');
//前台积分抽奖详情
Route::get('/lottery_info','Home\LotteryController@info');
//前台积分抽奖AJAX
Route::match(['get','post'],'/lottery_ajax','Home\LotteryController@ajaxs');
//前台邀请注册活动首页
Route::get('/invite','Home\InviteController@index');
//前台邀请注册活动详情
Route::match(['get','post'],'/invite_add','Home\InviteController@add');

Route::get('/invite_adds','Home\InviteController@adds');




//后台权限管理
Route::get('/admin_node','Admin\NodeController@index');
//后台权限添加
Route::get('/admin_node_add','Admin\NodeController@add');
//后台权限入库
Route::match(['get','post'],'/admin_node_do','Admin\NodeController@add_do');
//后台权限修改
Route::get('/admin_node_update','Admin\NodeController@update');
//后台权限入库
Route::match(['get','post'],'/admin_node_updates','Admin\NodeController@update_do');
//后台权限删除
Route::get('/admin_node_del','Admin\NodeController@del');

//后台角色管理
Route::get('/admin_role','Admin\RoleController@index');
//后台角色添加
Route::get('/admin_role_add','Admin\RoleController@add');
//后台角色入库
Route::match(['get','post'],'/admin_role_do','Admin\RoleController@add_do');

//后台用户管理
Route::get('/admin_user','Admin\UserController@index');
//后台用户添加角色
Route::get('/admin_user_add','Admin\UserController@add');
//后台添加角色入库
Route::match(['get','post'],'/admin_user_do','Admin\UserController@add_do');

//后台登录
Route::match(['get','post'],'/admin_logins','Admin\LoginController@login_do');
//验证码
Route::match(['get','post'],'/admin_verify','Admin\LoginController@verify');
//后台退出登陆
Route::get('/admin_logout','Admin\LoginController@logout');



//后台借款管理
Route::get('/admin_borrow','Admin\BorrowController@index');
//后台借款修改状态
Route::get('/admin_borrow_update','Admin\BorrowController@update');
//后台借款修改状态操作
Route::match(['get','post'],'/admin_borrow_updates','Admin\BorrowController@update_do');
//后台首页
Route::get('/admin_indexs','Admin\IndexController@index_info');
//老景
Route::get("admin_pro_add","Admin\ProblemController@index");
Route::post("add/problem","Admin\ProblemController@add");
Route::get("repayment","Home\RepaymentController@index");
Route::get("jsq","Home\JsqController@index");
//计算器
Route::get("/counter","Home\CounterController@index");
//风险评估
Route::get("survey","Home\ProblemController@index");
Route::get("up/assess","Home\ProblemController@up_assess");
Route::get("admin_pro_show","Admin\ProblemController@show");
Route::post("admin_ajax_pro","Admin\ProblemController@pro_ajax_info");
Route::post("admin_ajax_up","Admin\ProblemController@pro_ajax_update");
Route::post("admin_ajax_del","Admin\ProblemController@pro_ajax_del");
Route::get("demos","Home\DemoController@demos");
Route::get("timeUp","Home\SelljyzController@timeUpdate");
Route::get("refundrequst","Home\RefundController@ref");
Route::get("ifprice","Home\RefundController@ifprice");
Route::get("jisuanlilv","Home\RefundController@jisuanlilv");
Route::get("onehuan","Home\RefundController@onehuan");

//我要投资
Route::get("/invest",'Home\InvestController@index');
//投资标列表
Route::post("/invest_list",'Home\InvestController@lists');
//投资者信息
Route::get("/invest_info",'Home\InvestController@info');
//授权信息
Route::post("/invest_empower" ,'Home\InvestController@empower');
//借款者信息
Route::post("/lender",'Home\InvestController@lender');
//投标人信息列表
Route::post("/order_list",'Home\InvestController@order_list');
//当前会员资金
Route::post("/invest_user_info",'Home\InvestController@user_info');
//投资动作
Route::post("/user_invest",'Home\InvestController@user_invest');
//投资信息
Route::post("/lend_msg",'Home\InvestController@lend_msg');
//投资协议 return view('home.invest.index');
Route::get('/invest_msg','Home\InvestController@invest_msg');
//同一个标只能投一次
Route::get('/one','Home\InvestController@one');
//自己的标不能投
Route::get('/own','Home\InvestController@own');

/**
 * 网站基本设置
 */
//轮播图展示
Route::get('/slideshow','Admin\BasicController@slideshow');
//添加轮播图
Route::match(['get','post'],'/addSlideshow','Admin\BasicController@addSlideshow');
//删除轮播图
Route::get('/delSlideshow/{id}','Admin\BasicController@delSlideshow')->where(['id'=>'[0-9]+']);
//修改轮播图
Route::match(['get','post'],'/saveSlideshow/{id}','Admin\BasicController@saveSlideshow')->where(['id'=>'[0-9]+']);
//后台网站设置
Route::get('/admin_info','Admin\BasicController@site_settings');
Route::post('/admin_info_add','Admin\BasicController@add_site_settings');
//后台导航设置
Route::match(['get','post'],'/admin_nav','Admin\BasicController@nav');
//友情链接设置
Route::get('/admin_partner','Admin\BasicController@partner');
Route::match(['get','post'],'/admin_add_partner','Admin\BasicController@add_partner');
Route::get('/savePartner/{id}','Admin\BasicController@savePartner');
Route::get('/delPartner/{id}','Admin\BasicController@delPartner');
//交易记录
Route::get('/carry_list','Admin\DealController@carry_list');
Route::get('/recharge_list','Admin\DealController@recharge_list');
//删除提现记录
Route::get('/delCarry/{id}','Admin\DealController@delCarry')->where(['id'=>'[0-9]+']);
Route::get('/delRecharge/{id}','Admin\DealController@delRecharge')->where(['id'=>'[0-9]+']);
Route::get("userList","Admin\UserListController@userList");
Route::get("userListAjax","Admin\UserListController@ajax");

//防报错
 Route::get('/{name}', function () {
     return  view("skip/report",['msg'=>'页面未找到。。。。']);
 });



