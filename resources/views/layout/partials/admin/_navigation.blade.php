
<!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
          <div class="user-panel">
            <?php echo $squarelogo; ?>
            <div class="pull-left image">
              <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo $username;?></p>
              
            </div>
          </div>
          
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
             <?php
              foreach($links as $link){
                ?>
                <li class="treeview">
                  <a href=<?php echo $link['link'];?>
                     <i <?php echo $link['class'];?>></i> <span style ='font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;'><?php echo $link['label'];?> </span>
                  </a>
                 </li>
                <?php
              }
             ?>

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
