<div class="sidebar ms-0">

    <h3 class="sidebar-title">Search</h3>
    <div class="sidebar-item search-form">
        <form action="/search" method="GET">
            <input type="text" name="search_query" placeholder="Search..." required>
            <button type="submit"><i class="bi bi-search"></i></button>
        </form>
    </div>
    <!-- End sidebar search formn-->

    <!-- Related Post -->
    <h3 class="sidebar-title">Related Posts</h3>
    <?php foreach ($related_post as $row) : ?>
        <div class="sidebar-item recent-posts">
            <div class="post-item clearfix">
                <a href="/post/<?= $row['post_slug']; ?>">
                    <img src="/assets/backend/images/post/<?= $row['post_image']; ?>" alt="">
                    <h4>
                        <a href="/post/<?= $row['post_slug']; ?>"><?= $row['post_title']; ?></a>
                    </h4>
                    <time datetime="2021-01-01"><?= date('d M Y', strtotime($row['post_date'])); ?></time>
                </a>
            </div>
        </div>
    <?php endforeach; ?>
    <!-- End Related Post -->

    <!-- Tags -->
    <h3 class="sidebar-title">Tags</h3>
    <div class="sidebar-item tags">
        <ul>
            <?php foreach ($tags as $tag) : ?>
                <li><a href="/tag/<?= $tag['tag_name']; ?>"><?= $tag['tag_name']; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    <!-- End sidebar tags-->

</div>