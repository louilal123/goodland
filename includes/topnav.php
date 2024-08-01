<?php
session_start();
require_once __DIR__ . '/../admin/classes/Main_class.php';

$mainClass = new Main_class();

$notifications = [];

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $notifications = $mainClass->getUserNotifications($user_id);
    $unread_count = $mainClass->getUnreadNotificationCount($user_id);
}

$page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'], "/") + 1);
?>

<style>
    .itemsnav {
        font-size: 18px !important;
    }
    .getstarted {
        color: white !important;
    }
    .getstarted:hover {
        color: white;
        background-color: transparent !important;
    }
    .cart-icon {
        position: relative;
        display: inline-block;
    }
    .cart-icon .badge {
        position: absolute;
        top: -5px;
        right: -10px;
        background-color: red;
        color: white;
        padding: 2px 6px;
        border-radius: 50%;
    }
    .itemsnav {
    font-size: 18px !important;
    }
.notification-item {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}
.notification-item:hover {
    background-color: #f8f9fa;
}

</style>

<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">
        <a href="index.html" class="logo d-flex align-items-center me-auto me-lg-0">
            <h4 class="sitename" style="color: white; padding-top: 5px;"><strong>GOOD</strong><i>Land</i></h4>
        </a>

        <nav id="navmenu" class="navmenu mt-1">
            <ul>
                <li><a href="index" class="itemsnav <?= $page == 'index.php' ? 'active' : '' ?>">HOME</a></li>
                <li><a href="aboutus" class="itemsnav <?= $page == 'aboutus.php' ? 'active' : '' ?>">ABOUT US</a></li>
                <li><a href="projects" class="itemsnav <?= $page == 'projects.php' ? 'active' : '' ?>">PROJECTS</a></li>
                <li><a href="methodology" class="itemsnav <?= $page == 'methodology.php' ? 'active' : '' ?>">METHODOLOGY</a></li>
                <li><a href="stories" class="itemsnav <?= $page == 'stories.php' ? 'active' : '' ?>">STORIES</a></li>
                <li><a href="library" class="itemsnav <?= $page == 'library.php' ? 'active' : '' ?>">ARCHIVES</a></li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <?php if (isset($_SESSION['user_logged_in']) && $_SESSION['user_logged_in'] === true): ?>
            <div class="nav-item dropdown user-menu">
 
            <div class="d-flex align-items-center">
                <a href="#" class="nav-link d-flex align-items-center" style="margin-top: 2px; color: white;" data-bs-toggle="dropdown" aria-expanded="false" id="userDropdown">
                <img src="uploads/<?= htmlspecialchars($_SESSION['user_photo']  ?? 'uploads/try.png'); ?>"class="user-image rounded-circle shadow" style="width: 40px; height: 40px;">
                    <span class="d-none d-md-inline text-light" style="margin-top: 5px; color: white;">
                        <?= $_SESSION['user_fullname']; ?>
                         <i class="fas fa-chevron-down"></i>
                    </span>
                </a>
                <ul class="dropdown-menu fade dropdown-menu-lg dropdown-menu-end bg-light" aria-labelledby="userDropdown" style="border-radius: 0px !important; width: 300px !important; color: white !important;">
                    <li><hr class="dropdown-divider" style="border-color: white;"></li>
                    <li><a class="dropdown-item text-start" href="profile" style="color: black;"><i class="bi bi-person"></i> Profile</a></li>
                    <li><a class="dropdown-item mb-2" href="classes/logout.php" style="color: black;"><i class="bi bi-power"></i> Logout</a></li>
                </ul>

                    <div class="cart-icon ms-3 dropdown">
                        <a href="#" class="nav-link d-flex align-items-center" data-bs-toggle="dropdown" aria-expanded="false" id="cartDropdown" style="font-size: 1.5rem; color: white;">
                            <i class="bi bi-bell" style="font-size: 18px;"></i>
                            <span class="badge badge-notifications" style="font-size: 12px;"><?= $unread_count; ?></span>
                            <i class="fas fa-chevron-down"></i>
                        </a>
                        <ul class="dropdown-menu fade dropdown-menu-end bg-light cart-dropdown" aria-labelledby="cartDropdown" style="width: 500px; border-radius: 0px !important;">
                            <li class="d-flex flex-column align-items-center text-center">
                                <span class="dropdown-item text-center mt-2" style="color: black;">Notifications</span>
                                <a href="#" id="markAllRead" class="dropdown-item text-center" style="color: black;">Mark all as read</a>
                                <hr class="dropdown-divider" style="border-color: black;">
                                <?php foreach ($notifications as $notification): ?>
                                    <a href="#" class="dropdown-item notification-item text-start" style="color: black;" 
                                    data-id="<?= $notification['id']; ?>">
                                        <?= $notification['message']; ?>
                                        <br><small class="text-muted"><?= $notification['created_at']; ?></small>
                                    </a>
                                <?php endforeach; ?>
                            </li>
                        </ul>
                    </div>
                    <div class="ms-3 dropdown">
                        <a href="upload_file.php" class="nav-link d-flex align-items-center" style="font-size: 1.5rem; color: white;">
                            <i class="bi bi-upload" style="font-size: 18px;"></i>
                        </a>
                    </div>
            </div>

</div>

        <?php else: ?>
            <a href="get-started" class="btn btn-outline-primary getstarted">Get Started</a>
        <?php endif; ?>
    </div>
</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const markAllReadBtn = document.getElementById('markAllRead');
    const notificationItems = document.querySelectorAll('.notification-item');

    markAllReadBtn.addEventListener('click', function(e) {
        e.preventDefault();
        fetch('mark_all_notifications_read.php', {
            method: 'POST',
            body: JSON.stringify({ user_id: <?= $userId; ?> }),
            headers: {
                'Content-Type': 'application/json'
            }
        }).then(response => response.json())
        .then(data => {
            if (data.success) {
                document.querySelector('.badge-notifications').textContent = '0';
                notificationItems.forEach(item => {
                    item.classList.remove('unread');
                });
            }
        });
    });

    notificationItems.forEach(item => {
        item.addEventListener('click', function(e) {
            const notificationId = e.currentTarget.getAttribute('data-id');
            fetch('mark_notification_read.php', {
                method: 'POST',
                body: JSON.stringify({ notification_id: notificationId }),
                headers: {
                    'Content-Type': 'application/json'
                }
            }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    e.currentTarget.classList.remove('unread');
                    const unreadCount = document.querySelectorAll('.notification-item.unread').length;
                    document.querySelector('.badge-notifications').textContent = unreadCount;
                }
            });
        });
    });
});
</script>



