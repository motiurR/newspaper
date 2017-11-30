<div class="sakhatkar">
    <h2 class="text-center"><a href="#">সাক্ষাৎকার</a></h2>
    <div class="sakhatar-details">
        <hr />
        <?php
        $news = new NewsAddN();
        $interviewNews = $news->getAllInterviewNews();
        if ($interviewNews) {
            while ($result = $interviewNews->fetch_assoc()) {
                ?>
                <div class="sakhtatkar-content">
                    <div class="col-lg-4">
                        <a href="singlenews.php?nurl=<?php echo $result['news_url']; ?>">
                            <img src="global-panel/<?php echo $result['image']; ?>" alt="noname" class="img-responsive"/>
                        </a>
                    </div>
                    <div class="col-lg-8 text">
                        <h4>
                            <a href="singlenews.php?nurl=<?php echo $result['news_url']; ?>">
                                <?php echo $result['news_title']; ?>
                            </a>
                        </h4>
                    </div>

                </div><hr/>
            <?php }
        } ?>
    </div>
</div>
</div>