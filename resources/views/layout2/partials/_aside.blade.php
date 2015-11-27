		
		<div class="custom-menu-wrapper no-print">
		    <div class="pure-menu custom-menu custom-menu-top">
		        <a href="/home" class="pure-menu-heading custom-menu-brand">DILG - travel [<?php echo $department;?>]</a>
		        <a href="#" class="custom-menu-toggle" id="toggle"><s class="bar"></s><s class="bar"></s></a>
		    </div>
		    <div class="pure-menu pure-menu-horizontal pure-menu-scrollable custom-menu custom-menu-bottom custom-menu-tucked" id="tuckedMenu">
		        <div class="custom-menu-screen"></div>
		        <ul class="pure-menu-list">
        	            	 <?php
							  foreach($links as $link){
							    ?>
							        <li class="pure-menu-item"><a  class="pure-menu-link" href=<?php echo $link['link'];?> ><?php echo $link['label'];?></a></li>
							     
							    <?php
							  }
							 ?>

		        </ul>
		    </div>
		</div>