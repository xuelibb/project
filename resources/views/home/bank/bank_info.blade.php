<html>
<body>
<div class="ww">
    <?php include "layout/home/header.php";?>
</div>

<div class="ww both">
    <div class="bg_color1">
        <div class="wl mtauto ofh">
            <?php include "layout/home/user.php";?>
            <div class="fr content-right-x22 bg_color2">
                <div class="content-right-x2-title bdbt_e6">
                    <h3 class="fl fs20">银行卡管理</h3>
                    <a href="/web/user/bank_quota.html"><div class="fr fs14 fc_blue1 mt20">限额查询</div></a>
                </div>

                <div class="ofh">
                    <div class="fs12 fc_80 fstyle1 ofh sina-pay mt18 lh26 fl dib">
                        <span class="fl dib mr10 cash-sina-icon"></span>
                        <span class="fl dib mr10">新浪支付全程提供账户托管和支付服务</span>
                    </div>
                    @if($brank!=Null)
                    <div class="fr dib fs14 fstyle1 Bind-card-btn mt15" id="unbind">解绑</div>
                    @endif
                </div>
                @if($brank==Null)
                    <div class="ofh mt25">
                    <div class="fl dib recharge-box-fl psr recharge-box-fl-x1" style="display:block;">
                        <div class="add-bank-card-tips" onclick="bind_bank_box();">
                            <div class="add-bank-card-icon"></div>
                            <div class="fs16 fstyle1 fc_80 tc">添加银行卡</div>
                        </div>
                    </div>
                    </div>
                        @elseif($brank!=Null)
                            @foreach($brank as $k=>$v)
                                <?php
                            $bank_name=DB::table('bank_name')->where('bank_id',$v['bank_name_id'])->first();
                                ?>
                            <div class="ofh mt25">
                                <div class="fl dib recharge-box-fr" style="display:block;">
                                    <div class="ofh mt25">
                                        <div class="fl dib bank-icon"></div>
                                        <div class="fl dib">
                                            <div class="fs24 bold fc3 mt10">{{$bank_name['bank_name']}}</div>
                                            <div class="fs20 fc_80 fstyle3 mt25">{{$v['bank_card']}}</div>
                                        </div>
                                        <div class="fr dib pr15 fs14 fc_80 fstyle1 mt20">{{$bank_name['bank_type']}}</div>
                                    </div>
                                    <input type="hidden" value="{{$v['bank_id']}}" id="card_id">
                                    <div class="ofh fs18 fc0 bank-card-type mt20 bank-card-type-bg9">
                                        <div class="fl dib ml20">快捷卡支付已开通</div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        @endif


                <div class="fs14 fstyle1 fc_80 mt40 bd_e6 pl20 pt20 pb20">
                    <div><span class="block bold">温馨提示:</span></div>
                    <div class="ofh lh36 mt5" ><span class="fl dib">1、</span><p class="fl">平台支持绑定银行卡快捷支付和网银在线支付。</p></div>
                    <div class="ofh lh36"><span class="fl dib">2、</span><p class="fl">绑卡支付方式支持绑定1张银行卡（不支持绑定信用卡），用户今后在快捷充值与提现时，只能使用这张银行卡。</p></div>
                    <div class="ofh lh36"><span class="fl dib">3、</span><p class="fl">已绑定的银行卡可以解绑，解绑前需确保账户可用余额为0元；<span style="color: #e84318;">企业客户如需解绑银行卡请联系客服。</span> </p></div>
                    <div class="ofh lh36"><span class="fl dib">4、</span><p class="fl">如有疑问，请联系客服：400-8858-258（工作日:9:00-21:00）。</p></div>
                    <div class="ofh lh36"><span class="fl dib">5、</span><p class="fl">提示：中华人民共和国法律规定，冒用他人居民身份证的，由公安机关处二百元以上一千元以下罚款，<br/>或者处十日以下拘留，有违法所得的，没收违法所得。</p></div>
                </div>

                <div style="height:450px;">

                </div>
                <!--解绑-->
                <div class="popup-box-bg popup-out-box1" style="display:none;">
                    <div class="popup-box popup-box1 bg_color2  identity-popup-box">
                        <div class="fs16 fstyle1 fc3 tc pt80">你确定要删除此银行卡吗？</div>
                        <div class="ofh fs22">
                            <div class="fl dib binding-bankcard-btn" onclick="do_unbind();">确定</div>
                            <div class="fr dib unbundling-bankcard-btn" onclick="close_dialog('popup-out-box1');">取消</div>
                        </div>
                        <div class="popup-colse-btn"></div>
                    </div>
                </div>
                <input type="hidden" id="is_new" value="{{$model->is_new}}">
                <input type="hidden" id="_token" value="{{csrf_token()}}">

                <script>
                    var identity_type = Number("1");

                    $("#unbind").click(function(){
                        //$('.popup-out-box1').show();
                        layer.confirm('确定要解绑此银行卡吗？', function(index){
                            var url = "unbinding_bank_card";
                            var card_id = $("#card_id").val();
                            var _token=$("#_token").val();
                            //TODO格式验证
                            $.ajax({
                                url: url,
                                type: 'post',
                                data:{'card_id':card_id,'_token':_token},
                                dataType: 'json',
                                success:function(result){
                                    if(result.code == 1000) {
                                        //$("#ticket").val(result.data.ticket);
                                        layer.alert('解绑银行卡成功！', {icon:1});
                                        setTimeout(function(){window.location.reload();}, 3000);
                                    } else {
                                        layer.alert(result.msg, {icon:2});
                                    }
                                }
                            });
                        });
                    });


                    /**
                     * 绑定银行卡
                     */
                    function bind_bank_box() {
                        var verify_real = $("#is_new").val();
                        if(verify_real != 1) {
                            layer.open({
                                type: 2,
                                title: '实名认证',
                                fix: true,
                                shadeClose: true,
                                maxmin: false,
                                area: ['700px', '480px'],
                                content: "real_name_box",
                            });

                            return;
                        }
                        layer.open({
                            type: 2,
                            title: '绑定银行卡',
                            fix: true,
                            shadeClose: true,
                            maxmin: false,
                            area: ['455px', '580px'],
                            content: "binding_bank_card",
                        });
                    }

                </script>
            </div>
        </div>
    </div>
</div>
<style>
    .friend_link {
        padding: 0px 0 20px 0;
        float: right !important;
        text-align: center;
    }
    .friend_link a {
        margin: 0 14px 0 14px;
        text-align: center;
    }
    .friend-dl {
        width: 380px !important;
    }
</style>
<div class="ww">
    <!--底部 -->
    <?php include "layout/home/footer.php";?>
</div>
</body>
</html>
