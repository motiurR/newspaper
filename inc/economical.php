<div class="aourthoniti">
                        <div class="col-lg-4">
                            <div class="row">
                                <div class="aourthoniti-total-content">
                                    <a href="#"><h1>অর্থনীতি</h1></a>
                                    <hr />

                            <?php
                                 $news = new NewsAddN();
                                  $cricketTNews = $news->getAllEconomicalNews();
                                  if ($cricketTNews) {
                                    while ($result = $cricketTNews->fetch_assoc()) {
                             ?>
                                    <div class="total-content-2">
                                        <div class="col-lg-5">
                                            <a href="singlenews.php?nurl=<?php echo $result['news_url']; ?>">
                                                <img src="global-panel/<?php echo $result['image']; ?>" alt="Apurthoniti" />
                                            </a>
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="details">
                                                <h4><a href="singlenews.php?nurl=<?php echo $result['news_url']; ?>"><?php echo $fm->textShorten($result['news_summery'],200); ?></a></h4>
                                            </div>
                                        </div>
                                    </div>
                              <?php } } ?>      
                                    
                                </div>
                            </div>
                        </div>
                    </div>