<!DOCTYPE html>
<html>
<body class = 'metro'>
	<div class = 'container'>
		<form action = 'cluster_setup.php' method = 'post' id = '_cluster_setup' target = '_self'>
			<div class = '_contain_box_model'>
				<h3><label for = 'ID'>Protein ID</label></h3>
				<div class = 'input-control textarea'>
					<textarea name = 'ID' id = 'ID' readonly disabled><?= $id; ?></textarea> 
				</div>
				<input type = 'hidden' name = 'cluster' value = '1'>
			</div>
			<hr>
			<div class = '_contain_box_model'>
   			<div class="tab-control" data-role="tab-control">
   				 <ul class="tabs">
        				<li class="active"><a href="#_data_manipulation">Data Manipulation</a></li>
        				<li><a href="#_cluster_method">Cluster Method</a></li>
    				</ul>
 
    			<div class="frames">
				
					<!--  Data Manipulation Start  -->
        			<div class="frame" id="_data_manipulation">
					
						<!--   Wheter to choose Data   -->
						<div class = '_contain_box_model'>
							<legend>Whether to manipulate data</legend>
							<div class = 'input-control radio'>
								<label>
									<input type = 'radio' name = 'ifman' value = '0' onclick = 'enable();' checked>
									<span class = 'check'></span>
									Yes
								</label>
								<label>
									<input type = 'radio' name = 'ifman' value = '1' onclick = 'disable();'>
									<span class = 'check'></span>
									No
								</label>
							</div>
						</div>
						<!--    End  -->
						
						<!--   Data Manipulation Operation  -->
						<div class = '_contain_box_model'>
							<!--    Section 1    -->
							<div class = '_contain_box_model'>
								<div class = 'header'>
									<h3><b>Operation on Data</b></h3>
									<h3><b>Whether to perform</b></h3>
								</div>	
								<div class = 'input-control radio'>
									<h3 class = 'operation'>Log transformation</h3>
									<label>
										<input class = 'man' type = 'radio' value = '0' name = 'l'>
										<span class = 'check'></span>
										Yes
									</label>
									<label>
										<input class = 'man' type = 'radio' value = '1' name = 'l' checked>
										<span class = 'check'></span>
										No
									</label>
								</div>
								<div class = 'input-control radio'>
									<h3 class = 'operation'>Normalize each row of data</h3>
									<label>
										<input class = 'man' type = 'radio' value = '0' name = 'ng'>
										<span class = 'check'></span>
										Yes
									</label>
									<label>
										<input class = 'man' type = 'radio' value = '1' name = 'ng' checked>
										<span class = 'check'></span>
										No
									</label>
								</div>
								<div class = 'input-control radio'>
									<h3 class = 'operation'>Normailize each column of data</h3>
									<label>
										<input class = 'man' type = 'radio' value = '0' name = 'na'>
										<span class = 'check'></span>
										Yes
									</label>
									<label>
										<input class = 'man' type = 'radio' value = '1' name = 'na' checked>
										<span class = 'check'></span>
										No
									</label>
								</div>
							</div>
							<!--   Section One End   -->
						
							<!--    Section 2        -->
							<div class="accordion" data-role="accordion">
								<div class="accordion-frame">
									<a href="#" class="heading">Additional Operation</a>
									<div class = 'content'>
										<div class = '_contain_box_model'>
											<div class = 'header'>
												<h3><b>Additional Operation</b></h3>
											</div>
											<div class = 'input-control radio'>
												<h3 class = 'operation'>Center each row</h3>
												<label>
													<input class = 'man' type = 'radio' value = 'a' name = 'cg'>
													<span class = 'check'></span>
													Subtract the mean
												</label>
												<label>
													<input class = 'man' type = 'radio' value = 'm' name = 'cg'>
													<span class = 'check'></span>
													Subtract the median
												</label>
												<label>
													<input class = 'man' type = 'radio' value = 'None' name = 'cg' checked>
													<span class = 'check'></span>
													N/A
												</label>
											</div>
											<div class = 'input-control radio'>
												<h3 class = 'operation'>Center each column</h3>
												<label>
													<input class = 'man' type = 'radio' value = 'a' name = 'ca'>
													<span class = 'check'></span>
													Subtract the mean
												</label>
												<label>
													<input class = 'man' type = 'radio' value = 'm' name = 'ca'>
													<span class = 'check'></span>
													Subtract the median
												</label>
												<label>
													<input class = 'man' type = 'radio' value = 'None' name = 'ca' checked>
													<span class = 'check'></span>
													N/A
												</label>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!--    End    -->
						</div>
						<!--  End    -->
						
					</div>
					<!--   Data Manipulation Section End   -->
					
					<!--   Cluster View Setup Section  -->
        			<div class="frame" id="_cluster_method">
						<div class="tab-control" data-role="tab-control">
							<ul class="tabs">
								<li class="active"><a href="#_hierarchy" onclick = "method('1');">Hierarchical</a></li>
							<ul>
							<div class="frames">
								<!--    Method  :  Hierarchical	-->
								<div class="frame" id="_hierarchy">
								
									<!--    Distance Measure  -->
									<div class = '_contain_box_model'>
										<div class = 'header'>
											<h3><b>Specify the distance measure</b></h3>
										</div>
										<div class="accordion" data-role="accordion">
											<!--     Distance Measure Section 1 start -->
											<div class="accordion-frame">
												<a href="#" class="heading bg-blue">Protein Clustering</a>
												<div class="content">
													<div class = 'input-control radio'>
														<label class = 'protein_clustering'>
															<input class = 'clustering' checked type = 'radio' value = '1' name = 'g'>
															<span class = 'check'></span>
															Uncentered correlation
														</label>
														<label class = 'protein_clustering'>
															<input class = 'clustering' type = 'radio' value = '2' name = 'g'>
															<span class = 'check'></span>
															Pearson correlation
														</label>
														<label class = 'protein_clustering'>
															<input class = 'clustering' type = 'radio' value = '3' name = 'g'>
															<span class = 'check'></span>
															Uncentered correlation, absolute value
														</label>
														<label class = 'protein_clustering'>
															<input class = 'clustering' type = 'radio' value = '4' name = 'g'>
															<span class = 'check'></span>
															Pearson correlation, absolute value
														</label>
														<label class = 'protein_clustering'>
															<input class = 'clustering' type = 'radio' value = '5' name = 'g'>
															<span class = 'check'></span>
															Spearman's rank correlation
														</label>
														<label class = 'protein_clustering'>
															<input class = 'clustering' type = 'radio' value = '6' name = 'g'>
															<span class = 'check'></span>
															Kendall's tau
														</label>
														<label class = 'protein_clustering'>
															<input class = 'clustering' type = 'radio' value = '7' name = 'g'>
															<span class = 'check'></span>
															Euclidean distance
														</label>
														<label class = 'protein_clustering'>
															<input class = 'clustering' type = 'radio' value = '8' name = 'g'>
															<span class = 'check'></span>
															City-block distance
														</label>
													</div>
												</div>
											</div>
											<!--    Distance Measure Section 1 End    -->
											
											<!--    Distance Measure Section 2 Start   -->
											<div class="accordion-frame">
												<a href = "#" class = 'heading'>Microarray Clustering</a>
												<div class = 'content'>
													<div class = 'input-control radio'>
														<label class = 'microarray'>
															<input class = 'clustering' checked type = 'radio' value = '1' name = 'e'>
															<span class = 'check'></span>
															Uncentered correlation
														</label>
														<label class = 'microarray'>
															<input class = 'clustering' type = 'radio' value = '2' name = 'e'>
															<span class = 'check'></span>
															Pearson correlation
														</label>
														<label class = 'microarray'>
															<input class = 'clustering' type = 'radio' value = '3' name = 'e'>
															<span class = 'check'></span>
															Uncentered correlation, absolute value
														</label>
														<label class = 'microarray'>
															<input class = 'clustering' type = 'radio' value = '4' name = 'e'>
															<span class = 'check'></span>
															Pearson correlation, absolute value
														</label>
														<label class = 'microarray'>
															<input class = 'clustering' type = 'radio' value = '5' name = 'e'>
															<span class = 'check'></span>
															Spearman's rank correlation
														</label>
														<label class = 'microarray'>
															<input class = 'clustering' type = 'radio' value = '6' name = 'e'>
															<span class = 'check'></span>
															Kendall's tau
														</label>
														<label class = 'microarray'>
															<input class = 'clustering' type = 'radio' value = '7' name = 'e'>
															<span class = 'check'></span>
															Euclidean distance
														</label>
													</div>
												</div>
											</div>
											<!--    Distance Measure Section 2 End	-->
										</div>
									</div>
									<!---   Distance Measure End  -->
									
									<!--  Hierarchical clustering method start  -->
									<div class = '_contain_box_model'>
										<div class = 'header'>
											<h4><b>Hierarchical Clustering Method</b></h4>
										</div>
										<div class = 'input-control radio'>
											<label class = 'hierarchy'>
												<input checked type = 'radio' name = 'm' value = 'm'>
												<span class = 'check'></span>
												Pairwise complete-linkage
											</label>
											<label class = 'hierarchy'>
												<input type = 'radio' name = 'm' value = 's'>
												<span class = 'check'></span>
												Pairwise single-linkage
											</label>
											<label class = 'hierarchy'>
												<input type = 'radio' name = 'm' value = 'c'>
												<span class = 'check'></span>
												Pairwise centroid-linkage
											</label>
											<label class = 'hierarchy'>
												<input type = 'radio' name = 'm' value = 'a'>
												<span class = 'check'></span>
												Pairwise average-linkage
											</label>
										</div>
									</div>
									<!--  Hierarchical clustering method end   -->
								</div>
								<!--    Hierarchical   End   -->
							</div>
						</div>
					</div>
					<!--   Cluster View Section End	  -->
    			</div>
			</div>
			<input type = 'hidden' name = 'json' value = '<?= json_encode($receive_json); ?>'>
			<input type = 'hidden' name = '_submit' value = '_submit'>
		</form>
	</div>
	<form action = '../home.php' method = 'POST' id = 'backwards' target = '_parent'>
			<input type = 'hidden' name = 'OUTPUT' value = '<?= json_encode($receive_json);?>'>
			<input type = 'hidden' name = 'back' value = 'back'>
	</form>
	<div class = 'button_bfd'>
		<div class = 'back'>
			<button type = 'button' class = 'button_bf button large bg-green' onclick = "form_submit('backwards');">&lt;&lt;</button>
		</div>
		<div class = 'proceed'>
			<button type = 'button' class = 'button_bf button large bg-green' onclick = "form_submit('_cluster_setup');">&gt;&gt;</button>
		</div>
	</div>
	</div>
</body>
</html>
