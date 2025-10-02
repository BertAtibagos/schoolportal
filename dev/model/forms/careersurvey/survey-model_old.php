
<section>
    <style>
        input[type=checkbox]{
            margin-inline: 1rem;
        }
        .tblModal td{
            text-align: left;
            font-size: 18px;
            font-weight: normal;
        }

        .unselectable {
            -webkit-touch-callout: none; /* iOS Safari */
            -webkit-user-select: none; /* Safari */
            -khtml-user-select: none; /* Konqueror HTML */
                -moz-user-select: none; /* Old versions of Firefox */
                -ms-user-select: none; /* Internet Explorer/Edge */
                    user-select: none; /* Non-prefixed version, currently supported by Chrome, Edge, Opera and Firefox */
            display: inline;
        }
    </style>
    <!-- Button trigger modal -->
    <input type='button' class='btn btn-primary btnModalView' data-bs-toggle='modal' data-bs-target='#viewModal' style='font-size: 11px; font-family: Roboto, sans-serif; font-weight: normal; margin-right: 1rem; float: right;' value='Help'/>

    <div class="modal fade show" id="viewModal" tabindex="-1" aria-labelledby="label-modal" aria-hidden="true">
		<div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<p class="modal-title fs-5" id="label-modal" style='font-size: 2rem !important;'>Career Interest Survey</p>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<table class='table-hover table-responsive table-borderless tblModal'>
						<tbody>
							<tr>
								<td>
                                Disclaimer: The career survey used in this context has been modified from the original version created by SchoolWorks. The modified survey is intended solely for educational and informational purposes and should not be used for any other purpose without prior written consent from SchoolWorks.<br><br>
								</td>
							</tr>
							<tr>
								<td>
								    This survey will be used to determine your future career and job interests at this point in your life. It can also be used as a guide to help you make class choices
                                    for Junior High School/Senior High School/College.
								</td>
							</tr>	
							<tr>
								<td>
                                    <br>What to do: <br>
                                    <ul>
                                        <li>
                                            Check all the boxes in each section that best describe you and what you like to do.
                                        </li>
                                        <li>
                                            The total number of boxes checked will automatically be tallied in the Summary Tab.
                                        </li>
                                        <li>
                                            Each section will be given a rank based on the tallied number of boxes checked.
                                        </li>
                                    </ul>
                                   It's that easy! This will give you an idea of YOUR Top 3 Career Clusters to visit.
								</td>
							</tr>	
						</tbody>
					</table>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-primary bntClose" data-bs-dismiss="modal">Okay</button>
				</div>
			</div>
		</div>
	</div>

    <div id="errormessage">
        <p id='levelid' hidden></p>
        <p id='yearid' hidden></p>
        <p id='yearlevelid' hidden></p>
        <p id='periodid' hidden></p>
        <p id='courseid' hidden></p>
    </div>
    <div>
        <h4 style='padding-left: 1rem;'>Career Interest Survey</h4>
        <hr>
    </div>
    <nav>
        <div class="nav nav-tabs" id="nav-tab" role="tablist">
            <button class="nav-link active" id="nav-cluster1-tab" data-bs-toggle="tab" data-bs-target="#nav-cluster1" type="button" role="tab" aria-controls="nav-cluster1" aria-selected="true">Cluster 1</button>
            <button class="nav-link" id="nav-cluster2-tab" data-bs-toggle="tab" data-bs-target="#nav-cluster2" type="button" role="tab" aria-controls="nav-cluster2" aria-selected="false">Cluster 2</button>
            <button class="nav-link" id="nav-cluster3-tab" data-bs-toggle="tab" data-bs-target="#nav-cluster3" type="button" role="tab" aria-controls="nav-cluster3" aria-selected="false">Cluster 3</button>
            <button class="nav-link" id="nav-cluster4-tab" data-bs-toggle="tab" data-bs-target="#nav-cluster4" type="button" role="tab" aria-controls="nav-cluster4" aria-selected="false">Cluster 4</button>
            <button class="nav-link" id="nav-cluster5-tab" data-bs-toggle="tab" data-bs-target="#nav-cluster5" type="button" role="tab" aria-controls="nav-cluster5" aria-selected="false">Cluster 5</button>
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent" style='margin-top: 1rem;padding-bottom: 100px;'>
        <div class="tab-pane fade show active" id="nav-cluster1" role="tabpanel" aria-labelledby="nav-cluster1-tab">
            <div id="div-cluster1">
                <h4>Health Allied</h4>
                <p>Activities that sound interesting to me are:</p>
                    <input type="checkbox" id="word1" class="c1q1i1"><p class="unselectable" name="c1q1i1">Helping people stay healthy </p><br>
                    <input type="checkbox" id="word1" class="c1q1i2"><p class="unselectable" name="c1q1i2">Helping sick people</p><br>
                    <input type="checkbox" id="word1" class="c1q1i3"><p class="unselectable" name="c1q1i3">Taking care of animals' injuries and illnesses</p><br>
                    <input type="checkbox" id="word1" class="c1q1i4"><p class="unselectable" name="c1q1i4">Studying anatomy and disease </p><br>
                    <input type="checkbox" id="word1" class="c1q1i5"><p class="unselectable" name="c1q1i5">Helping with sports injuries</p><br><br>

                <p>Personal qualities that describe me are:</p>
                    <input type="checkbox" id="word1" class="c1q2i1"><p class="unselectable" name="c1q2i1">Compassionate and caring  </p><br>
                    <input type="checkbox" id="word1" class="c1q2i2"><p class="unselectable" name="c1q2i2">Good listener</p><br>
                    <input type="checkbox" id="word1" class="c1q2i3"><p class="unselectable" name="c1q2i3">Good at following directions</p><br>
                    <input type="checkbox" id="word1" class="c1q2i4"><p class="unselectable" name="c1q2i4">Conscientious and careful</p><br>
                    <input type="checkbox" id="word1" class="c1q2i5"><p class="unselectable" name="c1q2i5">Patient</p><br> <br>

                <p>In my free time I enjoy:</p>
                    <input type="checkbox" id="word1" class="c1q3i1"><p class="unselectable" name="c1q3i1">Volunteering in a hospital</p><br>
                    <input type="checkbox" id="word1" class="c1q3i2"><p class="unselectable" name="c1q3i2">Taking care of pets</p><br>
                    <input type="checkbox" id="word1" class="c1q3i3"><p class="unselectable" name="c1q3i3">Working at being healthy</p><br><br>

                <p>School subjects/activities that I enjoy or do well in:</p>
                    <input type="checkbox" id="word1" class="c1q4i1"><p class="unselectable" name="c1q4i1">Math</p><br>
                    <input type="checkbox" id="word1" class="c1q4i2"><p class="unselectable" name="c1q4i2">Science</p><br>
                    <input type="checkbox" id="word1" class="c1q4i3"><p class="unselectable" name="c1q4i3">Biology</p><br>
                    <input type="checkbox" id="word1" class="c1q4i4"><p class="unselectable" name="c1q4i4">Chemistry</p><br><br>
            </div>
        </div>

        <div class="tab-pane fade" id="nav-cluster2" role="tabpanel" aria-labelledby="nav-cluster2-tab">
            <div id="div-cluster2">
                <h4>Arts & Communication</h4>
                <p>Activities that sound interesting to me are:</p>
                    <input type="checkbox" id="word2" class="c2q1i1"><p class="unselectable" name="c2q1i1">Reading or writing stories or articles</p><br>
                    <input type="checkbox" id="word2" class="c2q1i2"><p class="unselectable" name="c2q1i2">Creating scenery for plays</p><br>
                    <input type="checkbox" id="word2" class="c2q1i3"><p class="unselectable" name="c2q1i3">Designing advertisements </p><br>
                    <input type="checkbox" id="word2" class="c2q1i4"><p class="unselectable" name="c2q1i4">Taking photographs</p><br>
                    <input type="checkbox" id="word2" class="c2q1i5"><p class="unselectable" name="c2q1i5">Acting in a play or movie </p><br>
                    <input type="checkbox" id="word2" class="c2q1i6"><p class="unselectable" name="c2q1i6">Listening to/playing music</p><br><br>

                <p>Personal qualities that describe me are:</p>
                    <input type="checkbox" id="word2" class="c2q2i1"><p class="unselectable" name="c2q2i1">Imaginative</p><br>
                    <input type="checkbox" id="word2" class="c2q2i2"><p class="unselectable" name="c2q2i2">Creative</p><br>
                    <input type="checkbox" id="word2" class="c2q2i3"><p class="unselectable" name="c2q2i3">Outgoing</p><br>
                    <input type="checkbox" id="word2" class="c2q2i4"><p class="unselectable" name="c2q2i4">Like using hands to create things</p><br>
                    <input type="checkbox" id="word2" class="c2q2i5"><p class="unselectable" name="c2q2i5">Performer</p><br><br>

                <p>In my free time I enjoy:</p>
                    <input type="checkbox" id="word2" class="c2q3i1"><p class="unselectable" name="c2q3i1">Working on the school newspaper</p><br>
                    <input type="checkbox" id="word2" class="c2q3i2"><p class="unselectable" name="c2q3i2">Acting in a play</p><br>
                    <input type="checkbox" id="word2" class="c2q3i3"><p class="unselectable" name="c2q3i3">Painting pictures, drawing</p><br><br>

                <p>School subjects/activities that I enjoy or do well in:</p>
                    <input type="checkbox" id="word2" class="c2q4i1"><p class="unselectable" name="c2q4i1">Speech/drama</p><br>
                    <input type="checkbox" id="word2" class="c2q4i2"><p class="unselectable" name="c2q4i2">Choir/chorus/band/orchestra</p><br>
                    <input type="checkbox" id="word2" class="c2q4i3"><p class="unselectable" name="c2q4i3">Creative writing</p><br>
                    <input type="checkbox" id="word2" class="c2q4i4"><p class="unselectable" name="c2q4i4">Art</p><br><br>
            </div>
        </div>
        
        <div class="tab-pane fade" id="nav-cluster3" role="tabpanel" aria-labelledby="nav-cluster3-tab">
            <div id="div-cluster3">
                <h4>Business & Management</h4>
                <p>Activities that sound interesting to me are:</p>
                    <input type="checkbox" id="word3" class="c3q1i1"><p class="unselectable" name="c3q1i1">Interviewing people</p><br>
                    <input type="checkbox" id="word3" class="c3q1i2"><p class="unselectable" name="c3q1i2">Working with a computer program</p><br>
                    <input type="checkbox" id="word3" class="c3q1i3"><p class="unselectable" name="c3q1i3">Making forms or banners</p><br>
                    <input type="checkbox" id="word3" class="c3q1i4"><p class="unselectable" name="c3q1i4">Taking notes at meetings</p><br>
                    <input type="checkbox" id="word3" class="c3q1i5"><p class="unselectable" name="c3q1i5">Being in charge of a group project</p><br><br>

                <p>Personal qualities that describe me are:</p>
                    <input type="checkbox" id="word3" class="c3q2i1"><p class="unselectable" name="c3q2i1">Practical</p><br>
                    <input type="checkbox" id="word3" class="c3q2i2"><p class="unselectable" name="c3q2i2">Independent</p><br>
                    <input type="checkbox" id="word3" class="c3q2i3"><p class="unselectable" name="c3q2i3">Organized</p><br>
                    <input type="checkbox" id="word3" class="c3q2i4"><p class="unselectable" name="c3q2i4">Like to use office equipment</p><br>
                    <input type="checkbox" id="word3" class="c3q2i5"><p class="unselectable" name="c3q2i5">Like to be around people</p><br><br>

                <p>In my free time I enjoy:</p>
                    <input type="checkbox" id="word3" class="c3q3i1"><p class="unselectable" name="c3q3i1">Being in a speech contest or debate</p><br>
                    <input type="checkbox" id="word3" class="c3q3i2"><p class="unselectable" name="c3q3i2">Working with a computer</p><br>
                    <input type="checkbox" id="word3" class="c3q3i3"><p class="unselectable" name="c3q3i3">Creating a business </p><br><br>

                <p>School subjects/activities that I enjoy or do well in:</p>
                    <input type="checkbox" id="word3" class="c3q4i1"><p class="unselectable" name="c3q4i1">Computers</p><br>
                    <input type="checkbox" id="word3" class="c3q4i2"><p class="unselectable" name="c3q4i2">Language arts</p><br>
                    <input type="checkbox" id="word3" class="c3q4i3"><p class="unselectable" name="c3q4i3">Math</p><br>
                    <input type="checkbox" id="word3" class="c3q4i4"><p class="unselectable" name="c3q4i4">Marketing</p><br><br>
            </div>
        </div>
        
        <div class="tab-pane fade" id="nav-cluster4" role="tabpanel" aria-labelledby="nav-cluster4-tab">
            <div id="div-cluster4">
                <h4>Public Service/Social/Behavioral Science/Humanities</h4>
                <p>Activities that sound interesting to me are:</p>
                    <input type="checkbox" id="word4" class="c4q1i1"><p class="unselectable" name="c4q1i1">Helping people solve problems</p><br>
                    <input type="checkbox" id="word4" class="c4q1i2"><p class="unselectable" name="c4q1i2">Working with children</p><br>
                    <input type="checkbox" id="word4" class="c4q1i3"><p class="unselectable" name="c4q1i3">Working with the elderly</p><br>
                    <input type="checkbox" id="word4" class="c4q1i4"><p class="unselectable" name="c4q1i4">Preparing food</p><br>
                    <input type="checkbox" id="word4" class="c4q1i5"><p class="unselectable" name="c4q1i5">Solving a mystery</p><br><br>

                <p>Personal qualities that describe me are:</p>
                    <input type="checkbox" id="word4" class="c4q2i1"><p class="unselectable" name="c4q2i1">Friendly</p><br>
                    <input type="checkbox" id="word4" class="c4q2i2"><p class="unselectable" name="c4q2i2">Open</p><br>
                    <input type="checkbox" id="word4" class="c4q2i3"><p class="unselectable" name="c4q2i3">Outgoing</p><br>
                    <input type="checkbox" id="word4" class="c4q2i4"><p class="unselectable" name="c4q2i4">Good at making decisions</p><br>
                    <input type="checkbox" id="word4" class="c4q2i5"><p class="unselectable" name="c4q2i5">Good Listener</p><br><br>

                <p>In my free time I enjoy:</p>
                    <input type="checkbox" id="word4" class="c4q3i1"><p class="unselectable" name="c4q3i1">Tutoring young children</p><br>
                    <input type="checkbox" id="word4" class="c4q3i2"><p class="unselectable" name="c4q3i2">Helping with a community project</p><br>
                    <input type="checkbox" id="word4" class="c4q3i3"><p class="unselectable" name="c4q3i3">Coaching kids in a sport</p><br><br>

                <p>School subjects/activities that I enjoy or do well in:</p>
                    <input type="checkbox" id="word4" class="c4q4i1"><p class="unselectable" name="c4q4i1">Language arts</p><br>
                    <input type="checkbox" id="word4" class="c4q4i2"><p class="unselectable" name="c4q4i2">Child development</p><br>
                    <input type="checkbox" id="word4" class="c4q4i3"><p class="unselectable" name="c4q4i3">Psychology/Sociology</p><br>
                    <input type="checkbox" id="word4" class="c4q4i4"><p class="unselectable" name="c4q4i4">History</p><br><br>
            </div>
        </div>
        
        <div class="tab-pane fade" id="nav-cluster5" role="tabpanel" aria-labelledby="nav-cluster5-tab">
            <div id="div-cluster5">
                <h4>Engineering & Technology</h4>
                <p>Activities that sound interesting to me are:</p>
                    <input type="checkbox" id="word5" class="c5q1i1"><p class="unselectable" name="c5q1i1">Putting things together</p><br>
                    <input type="checkbox" id="word5" class="c5q1i2"><p class="unselectable" name="c5q1i2">Working on mechanical things</p><br>
                    <input type="checkbox" id="word5" class="c5q1i3"><p class="unselectable" name="c5q1i3">Using math to solve problems</p><br>
                    <input type="checkbox" id="word5" class="c5q1i4"><p class="unselectable" name="c5q1i4">Repairing electronic equipment</p><br>
                    <input type="checkbox" id="word5" class="c5q1i5"><p class="unselectable" name="c5q1i5">Using tools</p><br><br>

                <p>Personal qualities that describe me are:</p>
                    <input type="checkbox" id="word5" class="c5q2i1"><p class="unselectable" name="c5q2i1">Practical</p><br>
                    <input type="checkbox" id="word5" class="c5q2i2"><p class="unselectable" name="c5q2i2">Like using my hand</p><br>
                    <input type="checkbox" id="word5" class="c5q2i3"><p class="unselectable" name="c5q2i3">Logical Thinker</p><br>
                    <input type="checkbox" id="word5" class="c5q2i4"><p class="unselectable" name="c5q2i4">Good at following directions</p><br>
                    <input type="checkbox" id="word5" class="c5q2i5"><p class="unselectable" name="c5q2i5">Observant</p><br><br>

                <p>In my free time I enjoy:</p>
                    <input type="checkbox" id="word5" class="c5q3i1"><p class="unselectable" name="c5q3i1">Building things</p><br>
                    <input type="checkbox" id="word5" class="c5q3i2"><p class="unselectable" name="c5q3i2">Figuring out how machines work</p><br>
                    <input type="checkbox" id="word5" class="c5q3i3"><p class="unselectable" name="c5q3i3">Working on cars</p><br><br>

                <p>School subjects/activities that I enjoy or do well in:</p>
                    <input type="checkbox" id="word5" class="c5q4i1"><p class="unselectable" name="c5q4i1">Math</p><br>
                    <input type="checkbox" id="word5" class="c5q4i2"><p class="unselectable" name="c5q4i2">Mechanics</p><br>
                    <input type="checkbox" id="word5" class="c5q4i3"><p class="unselectable" name="c5q4i3">Construction</p><br>
                    <input type="checkbox" id="word5" class="c5q4i4"><p class="unselectable" name="c5q4i4">Science</p><br><br>
            </div>
            <div style='margin-bottom: 2.5rem;'>
                <input type='button' id='btnSubmitResult' class='btn btn-primary' style='margin-right: 1rem; float: right;' value='Submit'/>
                <input type='button' id='btnSubmitResult2' class='btn btn-primary' style='margin-right: 1rem; float: right;' value='Submit'/>
                <input type='button' id='btnViewSummary' class='btn btn-primary' data-bs-toggle='modal' data-bs-target='#viewSummary' style='margin-right: 1rem; float: right;' value='View Results'/>
            </div>
        </div>

        <div class="modal fade" id="viewSummary" tabindex="-1" aria-labelledby="label-modal" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <p class="modal-title fs-5" id="label-modal" style='font-size: 1.75rem !important;'>Summary</p>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="div-summary" class='row d-flex p-2'>
                            <div id='divmessage' style="border: solid 2px #1cad00bf; background-color: #67ff0030; border-radius: 5px; margin-left: 1rem; padding: .5rem 1rem; width:95%;">
                                <p style="display: inline;"> You have successfully submitted the result! </p><p id='submittime' style="margin: 0; padding: 0; display: inline;">-</p>
                            </div>
                            <style>
                                #table-scores td, #table-scores th, #table-rank td, #table-rank th{
                                    font-size: 14px;
                                }
                                #cluster_desc{
                                    text-align: left;
                                }
                                td[name='cluster[]']{
                                    width: 15%;
                                }
                            </style>
                            <table class='table table-responsive table-bordered' style='margin:1rem; width:95%;' id='table-scores'>
                                <thead class='table-primary'>
                                    <tr>
                                        <th>#</th>
                                        <th colspan='2'>Score: </th>
                                        <th>Rank:</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> 1 </td>
                                        <td id="cluster_desc"> Cluster 1: Health Allied</td>
                                        <td id="cluster1" name="cluster[]">0</td>
                                        <td name="rank[]"> - </td>
                                    </tr>
                                    <tr>
                                        <td> 2 </td>
                                        <td id="cluster_desc"> Cluster 2: Arts & Communication</td>
                                        <td id="cluster2" name="cluster[]">0</td>
                                        <td name="rank[]"> - </td>
                                    </tr>
                                    <tr>
                                        <td> 3 </td>
                                        <td id="cluster_desc"> Cluster 3: Business & Management</td>
                                        <td id="cluster3" name="cluster[]">0</td>
                                        <td name="rank[]"> - </td>
                                    </tr>
                                    <tr>
                                        <td> 4 </td>
                                        <td id="cluster_desc"> Cluster 4: Public Service/Social/Behavioral Science/Humanities</td>
                                        <td id="cluster4" name="cluster[]">0</td>
                                        <td name="rank[]"> - </td>
                                    </tr>
                                    <tr>
                                        <td> 5 </td>
                                        <td id="cluster_desc"> Cluster 5: Engineering & Technology</td>
                                        <td id="cluster5" name="cluster[]">0</td>
                                        <td name="rank[]"> - </td>
                                    </tr>
                                    <tr>
                                        <td colspan='2' style='text-align: right;'> Total Score: </td>
                                        <td id="total_score" name="total_score">0</td>
                                        <td>  </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <div id='divmessage' style="border: solid 2px #ffc107; background-color: #ffc10730; border-radius: 5px; margin-left: 1rem; padding: .5rem 1rem; width:95%;">
                            <p style="display: inline;"> For the Part 2 of your Career Interest Survey, visit this website: <a href="https://www.cccstudent.org/homepages/view/1?show=yes" target="_blank">https://www.cccstudent.org/homepages/view/1?show=yes</a></p><br>
                            <p style="display: inline;"> Use this code: </p><p id='linkcode' style="margin: 0; padding: 0; display: inline;">-</p>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <!-- <button type="button" class="btn btn-primary bntClose" data-bs-dismiss="modal">Okay</button> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div style="display: none;" id="script_holder"></div>

<script>
    var currentDate = new Date();
    var dateString = currentDate.toISOString().replace(/[^0-9]/g, ''); // Remove non-numeric characters
    _string = '<script src="../../js/custom/survey-script_old.js?d=' + dateString + '"></';
    _string2 = 'script>';
    $('#script_holder').html(_string + _string2);
</script>

<!-- <script src="../../js/custom/survey-script_old.js"></script> -->