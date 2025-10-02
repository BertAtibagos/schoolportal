
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
                    <input type="checkbox" id="word1" class="c1q1i1"><label>Helping people stay healthy </label><br>
                    <input type="checkbox" id="word1" class="c1q1i2"><label>Helping sick people</label><br>
                    <input type="checkbox" id="word1" class="c1q1i3"><label>Taking care of animals' injuries and illnesses</label><br>
                    <input type="checkbox" id="word1" class="c1q1i4"><label>Studying anatomy and disease </label><br>
                    <input type="checkbox" id="word1" class="c1q1i5"><label>Helping with sports injuries</label><br><br>

                <p>Personal qualities that describe me are:</p>
                    <input type="checkbox" id="word1" class="c1q2i1"><label>Compassionate and caring  </label><br>
                    <input type="checkbox" id="word1" class="c1q2i2"><label>Good listener</label><br>
                    <input type="checkbox" id="word1" class="c1q2i3"><label>Good at following directions</label><br>
                    <input type="checkbox" id="word1" class="c1q2i4"><label>Conscientious and careful</label><br>
                    <input type="checkbox" id="word1" class="c1q2i5"><label>Patient</label><br> <br>

                <p>In my free time I enjoy:</p>
                    <input type="checkbox" id="word1" class="c1q3i1"><label>Volunteering in a hospital</label><br>
                    <input type="checkbox" id="word1" class="c1q3i2"><label>Taking care of pets</label><br>
                    <input type="checkbox" id="word1" class="c1q3i3"><label>Working at being healthy</label><br><br>

                <p>School subjects/activities that I enjoy or do well in:</p>
                    <input type="checkbox" id="word1" class="c1q4i1"><label>Math</label><br>
                    <input type="checkbox" id="word1" class="c1q4i2"><label>Science</label><br>
                    <input type="checkbox" id="word1" class="c1q4i3"><label>Biology</label><br>
                    <input type="checkbox" id="word1" class="c1q4i4"><label>Chemistry</label><br><br>
            </div>
        </div>

        <div class="tab-pane fade" id="nav-cluster2" role="tabpanel" aria-labelledby="nav-cluster2-tab">
            <div id="div-cluster2">
                <h4>Arts & Communication</h4>
                <p>Activities that sound interesting to me are:</p>
                    <input type="checkbox" id="word2" class="c2q1i1"><label>Reading or writing stories or articles</label><br>
                    <input type="checkbox" id="word2" class="c2q1i2"><label>Creating scenery for plays</label><br>
                    <input type="checkbox" id="word2" class="c2q1i3"><label>Designing advertisements </label><br>
                    <input type="checkbox" id="word2" class="c2q1i4"><label>Taking photographs</label><br>
                    <input type="checkbox" id="word2" class="c2q1i5"><label>Acting in a play or movie </label><br>
                    <input type="checkbox" id="word2" class="c2q1i6"><label>Listening to/playing music</label><br><br>

                <p>Personal qualities that describe me are:</p>
                    <input type="checkbox" id="word2" class="c2q2i1"><label>Imaginative</label><br>
                    <input type="checkbox" id="word2" class="c2q2i2"><label>Creative</label><br>
                    <input type="checkbox" id="word2" class="c2q2i3"><label>Outgoing</label><br>
                    <input type="checkbox" id="word2" class="c2q2i4"><label>Like using hands to create things</label><br>
                    <input type="checkbox" id="word2" class="c2q2i5"><label>Performer</label><br><br>

                <p>In my free time I enjoy:</p>
                    <input type="checkbox" id="word2" class="c2q3i1"><label>Working on the school newspaper</label><br>
                    <input type="checkbox" id="word2" class="c2q3i2"><label>Acting in a play</label><br>
                    <input type="checkbox" id="word2" class="c2q3i3"><label>Painting pictures, drawing</label><br><br>

                <p>School subjects/activities that I enjoy or do well in:</p>
                    <input type="checkbox" id="word2" class="c2q4i1"><label>Speech/drama</label><br>
                    <input type="checkbox" id="word2" class="c2q4i2"><label>Choir/chorus/band/orchestra</label><br>
                    <input type="checkbox" id="word2" class="c2q4i3"><label>Creative writing</label><br>
                    <input type="checkbox" id="word2" class="c2q4i4"><label>Art</label><br><br>
            </div>
        </div>
        
        <div class="tab-pane fade" id="nav-cluster3" role="tabpanel" aria-labelledby="nav-cluster3-tab">
            <div id="div-cluster3">
                <h4>Business & Management</h4>
                <p>Activities that sound interesting to me are:</p>
                    <input type="checkbox" id="word3" class="c3q1i1"><label>Interviewing people</label><br>
                    <input type="checkbox" id="word3" class="c3q1i2"><label>Working with a computer program</label><br>
                    <input type="checkbox" id="word3" class="c3q1i3"><label>Making forms or banners</label><br>
                    <input type="checkbox" id="word3" class="c3q1i4"><label>Taking notes at meetings</label><br>
                    <input type="checkbox" id="word3" class="c3q1i5"><label>Being in charge of a group project</label><br><br>

                <p>Personal qualities that describe me are:</p>
                    <input type="checkbox" id="word3" class="c3q2i1"><label>Practical</label><br>
                    <input type="checkbox" id="word3" class="c3q2i2"><label>Independent</label><br>
                    <input type="checkbox" id="word3" class="c3q2i3"><label>Organized</label><br>
                    <input type="checkbox" id="word3" class="c3q2i4"><label>Like to use office equipment</label><br>
                    <input type="checkbox" id="word3" class="c3q2i5"><label>Like to be around people</label><br><br>

                <p>In my free time I enjoy:</p>
                    <input type="checkbox" id="word3" class="c3q3i1"><label>Being in a speech contest or debate</label><br>
                    <input type="checkbox" id="word3" class="c3q3i2"><label>Working with a computer</label><br>
                    <input type="checkbox" id="word3" class="c3q3i3"><label>Creating a business </label><br><br>

                <p>School subjects/activities that I enjoy or do well in:</p>
                    <input type="checkbox" id="word3" class="c3q4i1"><label>Computers</label><br>
                    <input type="checkbox" id="word3" class="c3q4i2"><label>Language arts</label><br>
                    <input type="checkbox" id="word3" class="c3q4i3"><label>Math</label><br>
                    <input type="checkbox" id="word3" class="c3q4i4"><label>Marketing</label><br><br>
            </div>
        </div>
        
        <div class="tab-pane fade" id="nav-cluster4" role="tabpanel" aria-labelledby="nav-cluster4-tab">
            <div id="div-cluster4">
                <h4>Public Service/Social/Behavioral Science/Humanities</h4>
                <p>Activities that sound interesting to me are:</p>
                    <input type="checkbox" id="word4" class="c4q1i1"><label>Helping people solve problems</label><br>
                    <input type="checkbox" id="word4" class="c4q1i2"><label>Working with children</label><br>
                    <input type="checkbox" id="word4" class="c4q1i3"><label>Working with the elderly</label><br>
                    <input type="checkbox" id="word4" class="c4q1i4"><label>Preparing food</label><br>
                    <input type="checkbox" id="word4" class="c4q1i5"><label>Solving a mystery</label><br><br>

                <p>Personal qualities that describe me are:</p>
                    <input type="checkbox" id="word4" class="c4q2i1"><label>Friendly</label><br>
                    <input type="checkbox" id="word4" class="c4q2i2"><label>Open</label><br>
                    <input type="checkbox" id="word4" class="c4q2i3"><label>Outgoing</label><br>
                    <input type="checkbox" id="word4" class="c4q2i4"><label>Good at making decisions</label><br>
                    <input type="checkbox" id="word4" class="c4q2i5"><label>Good Listener</label><br><br>

                <p>In my free time I enjoy:</p>
                    <input type="checkbox" id="word4" class="c4q3i1"><label>Tutoring young children</label><br>
                    <input type="checkbox" id="word4" class="c4q3i2"><label>Helping with a community project</label><br>
                    <input type="checkbox" id="word4" class="c4q3i3"><label>Coaching kids in a sport</label><br><br>

                <p>School subjects/activities that I enjoy or do well in:</p>
                    <input type="checkbox" id="word4" class="c4q4i1"><label>Language arts</label><br>
                    <input type="checkbox" id="word4" class="c4q4i2"><label>Child development</label><br>
                    <input type="checkbox" id="word4" class="c4q4i3"><label>Psychology/Sociology</label><br>
                    <input type="checkbox" id="word4" class="c4q4i4"><label>History</label><br><br>
            </div>
        </div>
        
        <div class="tab-pane fade" id="nav-cluster5" role="tabpanel" aria-labelledby="nav-cluster5-tab">
            <div id="div-cluster5">
                <h4>Engineering & Technology</h4>
                <p>Activities that sound interesting to me are:</p>
                    <input type="checkbox" id="word5" class="c5q1i1"><label>Putting things together</label><br>
                    <input type="checkbox" id="word5" class="c5q1i2"><label>Working on mechanical things</label><br>
                    <input type="checkbox" id="word5" class="c5q1i3"><label>Using math to solve problems</label><br>
                    <input type="checkbox" id="word5" class="c5q1i4"><label>Repairing electronic equipment</label><br>
                    <input type="checkbox" id="word5" class="c5q1i5"><label>Using tools</label><br><br>

                <p>Personal qualities that describe me are:</p>
                    <input type="checkbox" id="word5" class="c5q2i1"><label>Practical</label><br>
                    <input type="checkbox" id="word5" class="c5q2i2"><label>Like using my hand</label><br>
                    <input type="checkbox" id="word5" class="c5q2i3"><label>Logical Thinker</label><br>
                    <input type="checkbox" id="word5" class="c5q2i4"><label>Good at following directions</label><br>
                    <input type="checkbox" id="word5" class="c5q2i5"><label>Observant</label><br><br>

                <p>In my free time I enjoy:</p>
                    <input type="checkbox" id="word5" class="c5q3i1"><label>Building things</label><br>
                    <input type="checkbox" id="word5" class="c5q3i2"><label>Figuring out how machines work</label><br>
                    <input type="checkbox" id="word5" class="c5q3i3"><label>Working on cars</label><br><br>

                <p>School subjects/activities that I enjoy or do well in:</p>
                    <input type="checkbox" id="word5" class="c5q4i1"><label>Math</label><br>
                    <input type="checkbox" id="word5" class="c5q4i2"><label>Mechanics</label><br>
                    <input type="checkbox" id="word5" class="c5q4i3"><label>Construction</label><br>
                    <input type="checkbox" id="word5" class="c5q4i4"><label>Science</label><br><br>
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

<script src="../../js/custom/survey-script_old.js"></script>