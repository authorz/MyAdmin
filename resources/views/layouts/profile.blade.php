<div id="sidebar-scroll-alt">
    <!-- Sidebar Content -->
    <div class="sidebar-content">
        <!-- Profile -->
        <div class="sidebar-section">
            <h2 class="text-light">我的信息</h2>
            <form action="" method="post" class="form-control-borderless"
                  onsubmit="return false;" id="myData">
                <div class="form-group">
                    <label for="side-profile-name">登录名 (不可修改)</label>
                    <input type="text" id="side-profile-name" name="side-profile-name" class="form-control"
                           value="{{ Session::get('UserLoginData.username') }}" disabled placeholder="登录名">
                </div>
                <div class="form-group">
                    <label for="side-profile-email">邮箱</label>
                    <input type="email" id="side-profile-email" name="side-profile-email"
                           class="form-control" value="" placeholder="邮箱未填写,请设置" required>
                </div>
                <div class="form-group remove-margin">
                    <button type="submit" class="btn btn-effect-ripple btn-primary">保存提交
                    </button>
                </div>
            </form>
        </div>
        <div class="sidebar-content">
            <!-- Profile -->
            <div class="sidebar-section">
                <h2 class="text-light">修改密码</h2>
                <form action="" method="post" class="form-control-borderless"
                      onsubmit="return false;" id="myPass">
                    <div class="form-group">
                        <label for="side-profile-password">新密码</label>
                        <input type="password" id="side-profile-password" name="side-profile-password"
                               class="form-control" placeholder="输入新密码">
                    </div>
                    <div class="form-group">
                        <label for="side-profile-password-confirm">确认密码</label>
                        <input type="password" id="side-profile-password-confirm"
                               name="side-profile-password-confirm" class="form-control"
                               placeholder="确认新密码">
                    </div>
                    <div class="form-group remove-margin">
                        <button type="submit" class="btn btn-effect-ripple btn-primary">保存提交
                        </button>
                    </div>
                </form>
            </div>
            <!-- END Profile -->
        </div>
        <!-- Settings -->
        <div class="sidebar-section">
            <h2 class="text-light">系统设置</h2>
            <form action="index.html" method="post" class="form-horizontal form-control-borderless"
                  onsubmit="return false;">
                <div class="form-group">
                    <label class="col-xs-7 control-label-fixed">站点状态</label>
                    <div class="col-xs-5">
                        <label class="switch switch-success"><input type="checkbox"
                                                                    checked><span></span></label>
                    </div>
                </div>
                <div class="form-group remove-margin">
                    <button type="submit" class="btn btn-effect-ripple btn-primary"
                            onclick="App.sidebar('close-sidebar-alt');">保存提交
                    </button>
                </div>
            </form>
        </div>
        <!-- END Settings -->
    </div>
    <!-- END Sidebar Content -->
</div>