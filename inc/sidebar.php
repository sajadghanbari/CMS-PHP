        <!-- Blog Sidebar Widgets Column -->
        <div class="col-md-4">

            <!-- Blog Search Well -->
            <div class="card bg-light">
                <div class="card-header">
                    <h4>Blog Search</h4>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="input-group">
                            <input type="text" class="form-control" name="searchQuery">
                            <span class="input-group-btn">
                                <button class="btn btn-primary" type="submit" name="searchSubmit">
                                    <span class="fa fa-search"></span>
                                </button>
                            </span>

                        </div>
                    </form>
                </div>
                <!-- /.input-group -->
            </div>

            <!-- Blog Categories Well -->
            <div class="card bg-light mt-4">
                <div class="card-header">
                    <h4>Blog Categories</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <?php
                        include_once "class/DB.php";
                        $cat = new Category();
                        $cats = $cat->getallcategories();
                        $cnt = count($cats);
                        ?>
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <?php
                        for ($i = 0; $i <= $cnt/2; $i++)
                        {
                         ?>
                                <li><a href="#"><?=$cats[$i]["name"]?></a></li>

                                <?php    
                        }
                        ?>
                            </ul>
                        </div>

                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <?php
                            for ($i = $cnt/2+1; $i < $cnt; $i++)
                        {
                         ?>
                                <li><a href="#"><?=$cats[$i]["name"]?></a></li>

                                <?php    
                        }
                        ?>
                            </ul>
                        </div>
                    </div>
                    <!-- /.col-lg-6 -->
                </div>
                <!-- /.row -->
            </div>

            <!-- Side Widget Well -->
            <div class="card bg-light mt-4">
                <div class="card-header">
                    <h4>Side Widget Well</h4>
                </div>
                <div class="card-body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci
                        accusamus
                        laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>
            </div>

        </div>