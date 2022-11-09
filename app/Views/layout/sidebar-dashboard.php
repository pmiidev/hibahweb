<div class="navbar">
    <div class="navbar-inner">
        <div class="sidebar-pusher">
            <a href="javascript:void(0);" class="waves-effect waves-button waves-classic push-sidebar">
                <i class="fa fa-bars"></i>
            </a>
        </div>
        <div class="logo-box">
            <a href="/<?= session('role'); ?>" class="logo-text"><span>PMII</span></a>
        </div><!-- Logo Box -->
        <div class="topmenu-outer">
            <div class="top-menu">
                <ul class="nav navbar-nav navbar-left">
                    <li>
                        <a href="javascript:void(0);" class="waves-effect waves-button waves-classic sidebar-toggle"><i class="fa fa-bars"></i></a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown"><i class="fa fa-envelope"></i><span class="badge badge-success pull-right"><?= $total_inbox; ?></span></a>
                        <ul class="dropdown-menu title-caret dropdown-lg" role="menu">

                            <li>
                                <p class="drop-title">Anda memiliki <?= $total_inbox; ?> pesan baru !</p>
                            </li>
                            <li class="dropdown-menu-list slimscroll messages">
                                <ul class="list-unstyled">
                                    <?php foreach ($inboxs as $row) : ?>
                                        <li>
                                            <a href="/<?= session('role') ?>/inbox/<?= $row['inbox_id']; ?>">
                                                <div class="msg-img">
                                                    <div class="online on"></div><img class="img-circle" src="/assets/backend/images/user_blank.png" alt="">
                                                </div>
                                                <p class="msg-name"><?= $row['inbox_name']; ?></p>
                                                <p class="msg-text"><?= word_limiter($row['inbox_message'], 5); ?></p>
                                                <p class="msg-time"><?= date('d-m-Y H:i:s', strtotime($row['inbox_created_at'])); ?></p>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                            <li class="drop-all"><a href="/<?= session('role'); ?>/inbox" class="text-center">All Messages</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown"><i class="fa fa-comment"></i><span class="badge badge-success pull-right"><?= $total_comment; ?></span></a>
                        <ul class="dropdown-menu title-caret dropdown-lg" role="menu">
                            <li>
                                <p class="drop-title">Anda memiliki <?= $total_comment; ?> komentar baru !</p>
                            </li>
                            <li class="dropdown-menu-list slimscroll messages">
                                <ul class="list-unstyled">
                                    <?php foreach ($comments as $row) : ?>
                                        <li>
                                            <a href="/<?= session('role'); ?>/comment">
                                                <div class="msg-img">
                                                    <div class="online on"></div><img class="img-circle" src="/assets/backend/images/user_blank.png" alt="">
                                                </div>
                                                <p class="msg-name"><?= $row['comment_name']; ?></p>
                                                <p class="msg-text"><?= word_limiter($row['comment_message'], 5); ?></p>
                                                <p class="msg-time"><?= date('d-m-Y H:i:s', strtotime($row['comment_date'])); ?></p>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </li>
                            <li class="drop-all"><a href="/<?= session('role'); ?>/comment" class="text-center">All Comments</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle waves-effect waves-button waves-classic" data-toggle="dropdown">
                            <span class="user-name"><?= session('name'); ?><i class="fa fa-angle-down"></i></span>
                            <img class="img-circle avatar" src="/assets/backend/images/<?= $akun['user_photo']; ?>" width="40" height="40" alt="">
                        </a>
                        <ul class="dropdown-menu dropdown-list" role="menu">
                            <li role="presentation"><a href="/backend/change_pass"><i class="fa fa-key"></i>Change Password</a></li>
                            <li role="presentation"><a href="/backend/comment/unpublish"><i class="fa fa-comment"></i>Comments<span class="badge badge-success pull-right"><?= $total_comment; ?></span></a></li>
                            <li role="presentation"><a href="/backend/inbox"><i class="fa fa-envelope"></i>Inbox<span class="badge badge-success pull-right"><?= $total_inbox; ?></span></a></li>
                            <li role="presentation" class="divider"></li>
                            <li role="presentation"><a href="/logout"><i class="fa fa-sign-out m-r-xs"></i>Log out</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="/logout" class="log-out waves-effect waves-button waves-classic">
                            <span><i class="fa fa-sign-out m-r-xs"></i>Log out</span>
                        </a>
                    </li>
                </ul><!-- Nav -->
            </div><!-- Top Menu -->
        </div>
    </div>
</div>
<div class="page-sidebar sidebar">
    <div class="page-sidebar-inner slimscroll">
        <div class="sidebar-header">
            <div class="sidebar-profile">
                <a href="javascript:void(0);">
                    <div class="sidebar-profile-image">
                        <img src="/assets/backend/images/<?= $akun['user_photo']; ?>" class="img-circle img-responsive" alt="">
                    </div>
                    <div class="sidebar-profile-details">
                        <span><?= session('nama'); ?><br>
                            <small>Administrator</small>
                        </span>
                    </div>
                </a>
            </div>
        </div>
        <ul class="menu accordion-menu">
            <li class="<?= ($active == 'dashboard') ? 'active' : '' ?>"><a href="/<?= session('role'); ?>" class="waves-effect waves-button"><span class="menu-icon icon-home"></span>
                    <p>Dashboard</p>
                </a></li>
            <li class="droplink <?= ($active == 'post') ? 'active' : '' ?>"><a href="#" class="waves-effect waves-button"><span class="menu-icon icon-pin"></span>
                    <p>Post</p><span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li><a href="/<?= session('role'); ?>/post">Post List</a></li>
                    <li><a href="/<?= session('role'); ?>/post/add_new">Add New</a></li>
                    <li><a href="/<?= session('role'); ?>/category">Category</a></li>
                    <li><a href="/<?= session('role'); ?>/tag">Tag</a></li>
                </ul>
            </li>
            <li class="<?= ($active == 'inbox') ? 'active' : '' ?>">
                <a href="/<?= session('role'); ?>/inbox" class="waves-effect waves-button"><span class="menu-icon icon-envelope"></span>
                    <p>Inbox</p>
                </a>
            </li>
            <li class="<?= ($active == 'comment') ? 'active' : '' ?>">
                <a href="/<?= session('role'); ?>/comment" class="waves-effect waves-button"><span class="menu-icon icon-bubbles"></span>
                    <p>Comments</p>
                </a>
            </li>
            <li class="<?= ($active == 'subscribers') ? 'active' : '' ?>">
                <a href="/<?= session('role'); ?>/subscriber" class="waves-effect waves-button"><span class="menu-icon icon-users"></span>
                    <p>Subscribers</p>
                </a>
            </li>
            <li class="<?= ($active == 'member') ? 'active' : '' ?>">
                <a href="/<?= session('role'); ?>/member" class="waves-effect waves-button"><span class="menu-icon icon-key"></span>
                    <p>Member</p>
                </a>
            </li>
            <li class="<?= ($active == 'testimonials') ? 'active' : '' ?>">
                <a href="/<?= session('role'); ?>/testimonial" class="waves-effect waves-button"><span class="menu-icon icon-like"></span>
                    <p>Testimonials</p>
                </a>
            </li>
            <li class="<?= ($active == 'teams') ? 'active' : '' ?>">
                <a href="/<?= session('role'); ?>/team" class="waves-effect waves-button"><span class="menu-icon icon-users"></span>
                    <p>Teams</p>
                </a>
            </li>
            <li class="<?= ($active == 'users') ? 'active' : '' ?>">
                <a href="/<?= session('role'); ?>/users" class="waves-effect waves-button"><span class="menu-icon icon-user"></span>
                    <p>Users</p>
                </a>
            </li>
            <li class="droplink <?= ($active == 'settings') ? 'active' : '' ?>"><a href="/<?= session('role'); ?>/settings" class="waves-effect waves-button"><span class="menu-icon icon-settings"></span>
                    <p>Settings</p><span class="arrow"></span>
                </a>
                <ul class="sub-menu">
                    <li><a href="/<?= session('role'); ?>/settings">Basic</a></li>
                    <li><a href="/<?= session('role'); ?>/home-setting">Home</a></li>
                    <li><a href="/<?= session('role'); ?>/about-setting">About</a></li>
                </ul>
            </li>
            <li>
                <a href="/logout" class="waves-effect waves-button"><span class="menu-icon icon-logout"></span>
                    <p>Log Out</p>
                </a>
            </li>
        </ul>
    </div>
</div>