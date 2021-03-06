<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="ico/favicon.ico">

    <title>Raspberry Pi Controller for Zeusminer by Tyson</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap theme -->
    <link href="css/bootstrap-theme.min.css" rel="stylesheet">

    <link href="css/font-awesome.min.css" rel="stylesheet">

    <link href="css/docs.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/theme.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]>
    <script src="js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body role="document">

<!-- Fixed navbar -->
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">RPC for Zeusminer</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="index.php"><i class="fa fa-star"></i> About</a></li>
                <li class="active"><a href="setting.php"><i class="fa fa-cog"></i> Setting</a></li>
                <li><a href="tail.php"><i class="fa fa-tachometer"></i> Status</a></li>
            </ul>
        </div>
        <!--/.nav-collapse -->
    </div>
</div>

<div class="container theme-showcase" role="main" id="setting_container">
    <script type="text/x-handlebars-template" id="setting_form_tpl">
        {{#if port}}
        <!-- 设备导航切换 -->
        <ul class="nav nav-tabs">
            {{#port}}
            <li class="{{#unless @index}}active{{/unless}}"><a href="javascript:void(0)" class="tabs-link" nav-index="{{this}}">{{this}}</a>
            </li>
            {{/port}}
        </ul>

        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron" id="setting_form_container">
            {{#port}}
            <div class="setting-form{{#unless @index}} setting-form-current{{/unless}}" id="setting_form_{{this}}">
                <div class="alert alert-success" style="display:none" id="notice_txt_{{this}}">
                    <strong>Note：</strong>
                </div>

                <form class="form-horizontal" role="form" method="post">
                    <fieldset class="pools-info-{{this}}">
                        <legend>Primary Pool</legend>
                        <div class="form-group">
                            <label for="pool" class="col-sm-2 control-label">Pool Address</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control url"  name="pool"
                                       value="stratum+tcp://"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="worker" class="col-sm-2 control-label">Worker Name</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control worker" name="work"
                                       placeholder="Please input the worker name" value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pwd" class="col-sm-2 control-label">Password</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control pwd" name="pwd" value="x"/>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset class="pools-info-{{this}}">
                        <legend>Backup Pool</legend>
                        <div class="form-group">
                            <label for="pool" class="col-sm-2 control-label">Pool Address</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control url"  name="pool"
                                       value="stratum+tcp://"/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="worker" class="col-sm-2 control-label">Worker Name</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control worker" name="work"
                                       placeholder="Please input the worker name" value=""/>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="pwd" class="col-sm-2 control-label">Password</label>

                            <div class="col-sm-10">
                                <input type="text" class="form-control pwd" name="pwd" value="x"/>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-group chips-group">
                        <label class="col-sm-2 control-label">Number of Chips</label>

                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input type="radio" name="miner_type" value="6" checked="checked">Blizzard
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="miner_type" value="64">Hurricane
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="miner_type" value="128">Thunder
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="miner_type" value="256">Lightning
                            </label>
                            <input type="text" class="form-control chips-count" id="chips_{{this}}" name="chips"
                                   value="6"/>
                        </div>
                    </div>
                    <div class="alert alert-info col-sm-offset-2 col-sm-10">
                        <strong>Note：</strong>If multiple miners are used, please change the number of chips manually.
                    </div>
                    <div class="form-group">
                        <label for="clock" class="col-sm-2 control-label">Frequency</label>

                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="clock_{{this}}" name="clock" value="328"/>
                        </div>
                    </div>
                    <div class="alert alert-info col-sm-offset-2 col-sm-10">
                        <strong>Note：</strong>Working frequency should be set properly. Damage caused by overclocking may void your warranty.
                    </div>

                    <div class="form-group">
                        <label class="col-sm-2 control-label">Parameter</label>

                        <div class="col-sm-10">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="nocheck_golden" id="nocheck_golden_{{this}}"
                                       value="nocheck-golden" checked="checked"><span
                                    title="Initialize with no Golden number check">nocheck-golden</span>
                            </label>
                            <label class="checkbox-inline">
                                <input type="checkbox" name="ltc_debug" id="ltc_debug_{{this}}" value="ltc-debug"
                                       checked="checked"><span title="Enable debug info output">ltc-debug</span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="button" class="btn btn-primary save-and-start" data-port="{{this}}"><i
                                    class="fa fa-floppy-o"></i> Save and Restart
                            </button>
                            <button type="button" class="btn btn-danger stop" data-port="{{this}}"><i
                                    class="fa fa-power-off"></i> Stop
                            </button>
                            <!-- <a class="btn btn-default" href="setting.php"><i class="fa fa-times"></i> Discard Change</a> -->
                        </div>
                    </div>
                </form>
            </div>
            {{/port}}
        </div>   <!-- end of jumbotron -->
        {{else}}
        <div class="alert alert-danger">
            <strong>Note：</strong>Can not detect miner.
        </div>
        {{/if}}
    </script>

</div>
<!-- /container -->

<?php include('footer.php'); ?>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery.min.js" type="text/javascript"></script>
<script src="js/bootstrap.min.js" type="text/javascript"></script>
<script src="js/docs.min.js" type="text/javascript"></script>
<script src="js/handlebars-v1.3.0.js" type="text/javascript"></script>

<script type="text/javascript">
    //页面的点击交互事件
    function interact_events(){
        //矿机切换
        $('.tabs-link').click(function () {
            $('.nav-tabs>li').removeClass('active');
            $(this).parent().addClass('active');

            var nav_index = $(this).attr('nav-index');
            $('.setting-form').removeClass('setting-form-current');
            $('#setting_form_' + nav_index).addClass('setting-form-current');
        });

        //选择芯片数
        $('.chips-group input[type=radio]').click(function () {
            $(this).parent().parent().children('.chips-count').val($(this).val());
        });
    }
    //绑定开启和停止事件
    function start_and_stop() {
        //保存并重启
        $('.save-and-start').click(function () {
            //端口
            var port = $(this).attr('data-port');
            //config数据
            var pool_arr = [];
            $('.pools-info-'+port).each(function(){
                var pool = {"url":$(this).find('.url').val(),"user":$(this).find('.worker').val(),"pass":$(this).find('.pwd').val()};
                pool_arr.push(pool);
            });
            var config_json = {
                "pools" : pool_arr,
                "scan-serial": "/dev/"+port,
                "scan-time": "30",
                "chips-count": $('#chips_' + port).val(),
                "ltc-clk": $('#clock_' + port).val(),
                "ltc-debug": $('#ltc_debug_' + port).is(':checked'),
                "nocheck-golden": $('#ltc_debug_' + port).is(':checked'),
                "api-listen": true,
                "api-network": true,
                "api-port": "1810" + port.substr(6,1),
                "api-description": "cgminer 3.1.1 zeus",
                "expiry": "60",
                "log": "5",
                "queue": "4",
                "scrypt": true
            };
            var config_string = JSON.stringify(config_json);
            $('#notice_txt_' + port).html('<strong>Note：</strong>Starting').attr('class', 'alert alert-warning').show();
            $.ajax({
                type: "POST",
                url: "PHPCgminer.php?action=start",
                data: {"port": port, "config_string": config_string},
                dataType: "text",
                success: function (data) {
                    if (data != '0') {
                        $('#notice_txt_' + port).html('<strong>Note：</strong>Operation fail').attr('class', 'alert alert-danger');
                    }
                },
                error: function () {
                    $('#notice_txt_' + port).html('<strong>Note：</strong>Cannot connect to server').attr('class', 'alert alert-danger');
                }
            });
        });

        //停止挖矿
        $('.stop').click(function () {
            var port = $(this).attr('data-port');
            $('#notice_txt_' + port).html('<strong>Note：</strong>Stopping').attr('class', 'alert alert-warning').show();
            $.ajax({
                type: "POST",
                url: "PHPCgminer.php?action=stop",
                data: {port: port},
                dataType: "text",
                success: function (data) {
                    if (data != '0') {
                        $('#notice_txt_' + port).html('<strong>Note：</strong>Operation fail').attr('class', 'alert alert-danger');
                    }
                },
                error: function () {
                    $('#notice_txt_' + port).html('<strong>Note：</strong>Cannot connect to server').attr('class', 'alert alert-danger');
                }
            });
        });
    }

    //读取配置文件，填入表单默认数据
    function read_config(port) {
        $.ajax({
            type: "POST",
            url: "PHPCgminer.php?action=read",
            data: {port:port},
            dataType: "text",
            success: function (data) {
                if (data != '') {
                    //获取json
                    var config_json = eval('(' + data + ')');
                    //填入表单数据
                    for(var i=0;i<config_json.pools.length;i++){
                        var $pools_info = $($('.pools-info-'+port).get(i));
                        $pools_info.find('.url').val(config_json.pools[i].url);
                        $pools_info.find('.worker').val(config_json.pools[i].user);
                        $pools_info.find('.pwd').val(config_json.pools[i].pass);
                    }
                    $('#chips_'+port).val(config_json['chips-count']);
                    $('#clock_'+port).val(config_json['ltc-clk']);
                    if (config_json['ltc-debug']) $('#ltc_debug_'+port).attr('checked', 'checked');
                    if (config_json['nocheck-golden']) $('#nocheck_golden_'+port).attr('checked', 'checked');
                }
            }
        });
    }
    function read_config_all(miner_port_arr){
        for(var i=0;i<miner_port_arr.length;i++){
            read_config(miner_port_arr[i]);
        }
    }


    //每一分钟检查一次矿机状态
    function check_miner(port) {
        $.ajax({
            type: "POST",
            url: "PHPCgminer.php?action=check",
            data:{port:port},
            dataType: "text",
            success: function (data) {
                if (data == '0') {
                    $('#notice_txt_' + port).html('<strong>Note：</strong>Mining').attr('class', 'alert alert-success');
                }
                else {
                    $('#notice_txt_' + port).html('<strong>Note：</strong>Mining stopped').attr('class', 'alert alert-danger');
                }
            },
            error: function () {
                $('#notice_txt_' + port).html('<strong>Note：</strong>Cannot connect to server').attr('class', 'alert alert-danger');
            },
            complete: function () {
                $('#notice_txt_' + port).show();
            }
        });
    }
    function check_miner_all(miner_port_arr) {
        if(miner_port_arr.length>0){
            window.setInterval(function(){
                for(var i=0;i<miner_port_arr.length;i++){
                    check_miner(miner_port_arr[i]);
                }
            },1000);
        }
    }


    //获取矿机列表
    (function get_miner_port() {
        $.ajax({
            type: "POST",
            url: "PHPCgminer.php?action=port",
            dataType: "text",
            success: function (data) {
                var port_arr = data.split(',');
                //var port_arr = ['ttyUSB0', 'ttyUSB1', 'ttyUSB2'];
                //去掉空值
                for (var i = 0; i < port_arr.length; i++) {
                    if (port_arr[i] == "" || typeof(port_arr[i]) == "undefined") {
                        port_arr.splice(i, 1);
                        i = i - 1;
                    }
                }
                var port_data = { port: port_arr};
                //渲染模板
                $('#setting_container').handlebars($('#setting_form_tpl'), port_data);

                interact_events();
                start_and_stop();
                check_miner_all(port_arr);
                read_config_all(port_arr);
            },
            error: function () {
                alert('Fail to get device port');
            }
        });
    })();
</script>
</body>
</html>
