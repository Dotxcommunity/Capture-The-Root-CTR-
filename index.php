<?php
session_start();

// Default username and password
$defaultUsername = "root";
$defaultPassword = "password";

// Challenges completed by the user (initialized to 0 if not set)
if (!isset($_SESSION['completed_challenges'])) {
    $_SESSION['completed_challenges'] = 0;
}

// Check if the user is already logged in
if (isset($_SESSION['username'])) {
    $loggedInUser = $_SESSION['username'];
} else {
    $loggedInUser = null;
}

// Handle login
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // Perform login validation (replace this with your actual validation logic)
    if ($username === $defaultUsername && $password === $defaultPassword) {
        // Store the username in session
        $_SESSION['username'] = $username;
        // Redirect to the same page to prevent form resubmission
        header("Location: index.php");
        exit();
    } else {
        // Display error message
        $error = "Invalid username or password";
    }
}

// Handle logout
if (isset($_POST['logout'])) {
    // Destroy the session
    session_unset();
    session_destroy();
    // Redirect to the same page to prevent form resubmission
    header("Location: index.php");
    exit();
}

// Handle challenge completion
function completeChallenge() {
    if (!isset($_SESSION['completed_challenges'])) {
        $_SESSION['completed_challenges'] = 0;
    }
    $_SESSION['completed_challenges']++; // Increment completed challenges
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Capture The Root</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
         body {
		height: 100vh;
		overflow-y: auto;
            background-color: #111;
            color: #00ff00;
            font-family: 'Courier New', monospace;
			
        }
        header, footer {
            background-color: #000;
            color: #00ff00;
            text-align: center;
            padding: 20px 0;
        }
        .container {
            margin: 20px auto;
            max-width: 800px;
        }
        .login-form {
            background-color: #333;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .nav-tabs {
            background-color: #222;
            border-radius: 8px;
            overflow: hidden;
            display: flex;
            justify-content: center;
        }
        .nav-tabs .nav-item {
            width: 50%;
        }
        .nav-link {
            color: #00ff00;
            border: none;
            border-radius: 0;
            text-align: center;
            padding: 10px 0;
            transition: all 0.3s;
            font-size: 16px;
        }
        .nav-link.active {
            background-color: #00ff00;
            color: #000;
            border-radius: 8px 8px 0 0;
        }
        .tab-content {
            background-color: #333;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            display: none;
            transition: all 0.3s;
        }
        .tab-content.active {
            display: block;
        }
        footer {
            background-color: #000;
            color: #00ff00;
            text-align: center;
            padding: 10px 0;
            position: fixed;
            bottom: 0;
            width: 100%;
            font-size: 14px;
        }
        footer p {
            margin-bottom: 0;
        }
        .flag-code {
            background-color: #222;
            color: #00ff00;
            border-radius: 4px;
            padding: 10px;
            margin-bottom: 20px;
        }
        .submit-btn {
            background-color: #00ff00;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            color: #000;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .submit-btn:hover {
            background-color: #007700;
        }
		
	.btn-setup {
    font-size: 20px;
    padding: 5px 204px;
    background-color: #4CAF50; /* Green color */
    color: #fff;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
	
}

.btn-setup:hover {
    background-color: #3b8132; /* Darker green color */
}

.btn-lg {
    padding: 5px 200px;
}		
		
    </style>
</head>
<body>
    <header>
        <h1>Capture The Root</h1>
        <p>Welcome to the Capture The Root challenge!</p>
    </header>
    <div class="container">
        <?php if($loggedInUser): ?>
		<center><h3>EVILXHACKER</h3></center>
            <!-- If logged in, show challenges -->
            <div class="alert alert-success">Logged in as <?php echo $loggedInUser; ?></div>
            <section>
			<br>
				<center>
					 <button class="btn-setup" onclick="redirectToSetupPage()">Setup</button>
					 </center>
					<br>
			<center>
                <form action="index.php" method="post">
                    <input type="hidden" name="logout" value="1">
                    <button type="submit" class="btn btn-danger btn-lg">Logout</button>
					</center>
                </form>
				<br>
				
				
            </section>
		
			
            <section>
                <!-- CTR Challenges Section -->

 

 <div class="mt-3">
            <div class="nav nav-tabs" id="navTabs">
                <a class="nav-item nav-link active" href="#" onclick="showTab('ctrChallenges')">CTR Challenges</a>
                <a class="nav-item nav-link" href="#" onclick="showTab('walkthrough')">Walkthrough</a>
            </div>
            <div class="tab-content mt-3" id="ctrChallenges">
               <h2>CTR Challenges</h2>
                <p>This is the Capture The Root page.</p>
				 <!-- Challenge 1 -->
			 <div id="challenge1">
                    <h3>FTP Challenge</h3>
                    <p>Exploit FTP service on port 21 and find the flag code.</p>
                    <div class="form-group">
                        <label for="flagCode1">Flag Code</label>
                        <input type="text" class="form-control" id="flagCode1" placeholder="Enter flag code">
                    </div>
                    <button class="submit-btn" onclick="submitFlag(1)">Submit Flag</button>
                    <button id="nextChallengeBtn1" class="submit-btn" style="display: none;" onclick="showNextChallenge(1)">Next Challenge</button>
                </div>
                <!-- Challenge 2 -->
                <div id="challenge2" style="display: none;">
                     <h3>SSH Challenge</h3>
                    <p>Exploit SSH service on port 22 and find the flag code.</p>
                    <div class="form-group">
                        <label for="flagCode2">Flag Code</label>
                        <input type="text" class="form-control" id="flagCode2" placeholder="Enter flag code">
                    </div>
                    <button class="submit-btn" onclick="submitFlag(2)">Submit Flag</button>
                    <button class="submit-btn" onclick="showPrevChallenge(2)">Previous Challenge</button>
                    <button id="nextChallengeBtn2" class="submit-btn" style="display: none;" onclick="showNextChallenge(2)">Next Challenge</button>
                </div>
                <!-- Challenge 3 -->
                <div id="challenge3" style="display: none;">
                    <h3>Telnet Challenge</h3>
                    <p>Exploit Telnet service on port 23 and find the flag code.</p>
                    <div class="form-group">
                        <label for="flagCode3">Flag Code</label>
                        <input type="text" class="form-control" id="flagCode3" placeholder="Enter flag code">
                    </div>
                    <button class="submit-btn" onclick="submitFlag(3)">Submit Flag</button>
                    <button class="submit-btn" onclick="showPrevChallenge(3)">Previous Challenge</button>
                    <button id="nextChallengeBtn3" class="submit-btn" style="display: none;" onclick="showNextChallenge(3)">Next Challenge</button>
                </div>
                <!-- Challenge 4 -->
                <div id="challenge4" style="display: none;">
                    <h3>SMTP Challenge</h3>
                    <p>Exploit SMTP service on port 25 and find the flag code.</p>
                    <div class="form-group">
                        <label for="flagCode4">Flag Code</label>
                        <input type="text" class="form-control" id="flagCode4" placeholder="Enter flag code">
                    </div>
                    <button class="submit-btn" onclick="submitFlag(4)">Submit Flag</button>
                    <button class="submit-btn" onclick="showPrevChallenge(4)">Previous Challenge</button>
                    <button id="nextChallengeBtn4" class="submit-btn" style="display: none;" onclick="showNextChallenge(4)">Next Challenge</button>
                </div>
<!-- Challenge 5 -->
                <div id="challenge5" style="display: none;">
                   <h3>ISC BIND Challenge</h3>
                    <p>Exploit ISC BIND service on port 53 and find the flag code.</p>
                    <div class="form-group">
                        <label for="flagCode5">Flag Code</label>
                        <input type="text" class="form-control" id="flagCode5" placeholder="Enter flag code">
                    </div>
                    <button class="submit-btn" onclick="submitFlag(5)">Submit Flag</button>
                    <button class="submit-btn" onclick="showPrevChallenge(5)">Previous Challenge</button>
                    <button id="nextChallengeBtn5" class="submit-btn" style="display: none;" onclick="showNextChallenge(5)">Next Challenge</button>
                </div>
          


<!-- Challenge 6 -->
                <div id="challenge6" style="display: none;">
                   <h3>Linux httpd Challenge</h3>
                    <p>Exploit Linux httpd service on port 80 and find the flag code.</p>
                    <div class="form-group">
                        <label for="flagCode6">Flag Code</label>
                        <input type="text" class="form-control" id="flagCode6" placeholder="Enter flag code">
                    </div>
                    <button class="submit-btn" onclick="submitFlag(6)">Submit Flag</button>
                    <button class="submit-btn" onclick="showPrevChallenge(6)">Previous Challenge</button>
                    <button id="nextChallengeBtn6" class="submit-btn" style="display: none;" onclick="showNextChallenge(6)">Next Challenge</button>
                </div>
            

<!-- Challenge 7 -->
                <div id="challenge7" style="display: none;">
                   <h3>RPC BIND Challenge</h3>
                    <p>Exploit RPC BIND service on port 111 and find the flag code.</p>
                    <div class="form-group">
                        <label for="flagCode7">Flag Code</label>
                        <input type="text" class="form-control" id="flagCode7" placeholder="Enter flag code">
                    </div>
                    <button class="submit-btn" onclick="submitFlag(7)">Submit Flag</button>
                    <button class="submit-btn" onclick="showPrevChallenge(7)">Previous Challenge</button>
                    <button id="nextChallengeBtn7" class="submit-btn" style="display: none;" onclick="showNextChallenge(7)">Next Challenge</button>
                </div>
            

<!-- Challenge 8 -->
                <div id="challenge8" style="display: none;">
                   <h3>Netbios-ssn Challenge</h3>
                    <p>Exploit Netbios-ssn service on port 139 and find the flag code.</p>
                    <div class="form-group">
                        <label for="flagCode8">Flag Code</label>
                        <input type="text" class="form-control" id="flagCode8" placeholder="Enter flag code">
                    </div>
                    <button class="submit-btn" onclick="submitFlag(8)">Submit Flag</button>
                    <button class="submit-btn" onclick="showPrevChallenge(8)">Previous Challenge</button>
                    <button id="nextChallengeBtn8" class="submit-btn" style="display: none;" onclick="showNextChallenge(8)">Next Challenge</button>
                </div>
          

<!-- Challenge 9 -->
                <div id="challenge9" style="display: none;">
                   <h3>R Services Challenge</h3>
                    <p>Exploit R service on port 512,513,514 and find the flag code.</p>
                    <div class="form-group">
                        <label for="flagCode9">Flag Code</label>
                        <input type="text" class="form-control" id="flagCode9" placeholder="Enter flag code">
                    </div>
                    <button class="submit-btn" onclick="submitFlag(9)">Submit Flag</button>
                    <button class="submit-btn" onclick="showPrevChallenge(9)">Previous Challenge</button>
                    <button id="nextChallengeBtn9" class="submit-btn" style="display: none;" onclick="showNextChallenge(9)">Next Challenge</button>
                </div>
            
			
			<!-- Challenge 10 -->
                <div id="challenge10" style="display: none;">
                   <h3>Java-rmi Challenge</h3>
                    <p>Exploit Java-rmi service on port 1099 and find the flag code.</p>
                    <div class="form-group">
                        <label for="flagCode10">Flag Code</label>
                        <input type="text" class="form-control" id="flagCode10" placeholder="Enter flag code">
                    </div>
                    <button class="submit-btn" onclick="submitFlag(10)">Submit Flag</button>
                    <button class="submit-btn" onclick="showPrevChallenge(10)">Previous Challenge</button>
                    <button id="nextChallengeBtn10" class="submit-btn" style="display: none;" onclick="showNextChallenge(10)">Next Challenge</button>
                </div>
          
			
			
			<!-- Challenge 11 -->
                <div id="challenge11" style="display: none;">
                   <h3>BIND Shell Challenge</h3>
                    <p>Exploit BIND Shell service on port 1524 and find the flag code.</p>
                    <div class="form-group">
                        <label for="flagCode11">Flag Code</label>
                        <input type="text" class="form-control" id="flagCode11" placeholder="Enter flag code">
                    </div>
                    <button class="submit-btn" onclick="submitFlag(11)">Submit Flag</button>
                    <button class="submit-btn" onclick="showPrevChallenge(11)">Previous Challenge</button>
                    <button id="nextChallengeBtn11" class="submit-btn" style="display: none;" onclick="showNextChallenge(11)">Next Challenge</button>
                </div>
            
			
			
			<!-- Challenge 12 -->
                <div id="challenge12" style="display: none;">
                   <h3>NFS Challenge</h3>
                    <p>Exploit NFS service on port 2049 and find the flag code.</p>
                    <div class="form-group">
                        <label for="flagCode12">Flag Code</label>
                        <input type="text" class="form-control" id="flagCode12" placeholder="Enter flag code">
                    </div>
                    <button class="submit-btn" onclick="submitFlag(12)">Submit Flag</button>
                    <button class="submit-btn" onclick="showPrevChallenge(12)">Previous Challenge</button>
                    <button id="nextChallengeBtn12" class="submit-btn" style="display: none;" onclick="showNextChallenge(12)">Next Challenge</button>
                </div>
            
			
			
			<!-- Challenge 13 -->
                <div id="challenge13" style="display: none;">
                   <h3>FTP Challenge</h3>
                    <p>Exploit FTP service on port 2121 and find the flag code.</p>
                    <div class="form-group">
                        <label for="flagCode13">Flag Code</label>
                        <input type="text" class="form-control" id="flagCode13" placeholder="Enter flag code">
                    </div>
                    <button class="submit-btn" onclick="submitFlag(13)">Submit Flag</button>
                    <button class="submit-btn" onclick="showPrevChallenge(13)">Previous Challenge</button>
                    <button id="nextChallengeBtn13" class="submit-btn" style="display: none;" onclick="showNextChallenge(13)">Next Challenge</button>
               
				</div>
            
			
			
			<!-- Challenge 14 -->
                <div id="challenge14" style="display: none;">
                   <h3>Mysql Challenge</h3>
                    <p>Exploit Mysql service on port 3306 and find the flag code.</p>
                    <div class="form-group">
                        <label for="flagCode14">Flag Code</label>
                        <input type="text" class="form-control" id="flagCode14" placeholder="Enter flag code">
                    </div>
                    <button class="submit-btn" onclick="submitFlag(14)">Submit Flag</button>
                    <button class="submit-btn" onclick="showPrevChallenge(14)">Previous Challenge</button>
                    <button id="nextChallengeBtn14" class="submit-btn" style="display: none;" onclick="showNextChallenge(14)">Next Challenge</button>
                </div>
            
			
			
			<!-- Challenge 15 -->
                <div id="challenge15" style="display: none;">
                   <h3>distcc Challenge</h3>
                    <p>Exploit distcc service on port 3632 and find the flag code.</p>
                    <div class="form-group">
                        <label for="flagCode15">Flag Code</label>
                        <input type="text" class="form-control" id="flagCode15" placeholder="Enter flag code">
                    </div>
                    <button class="submit-btn" onclick="submitFlag(15)">Submit Flag</button>
                    <button class="submit-btn" onclick="showPrevChallenge(15)">Previous Challenge</button>
                    <button id="nextChallengeBtn15" class="submit-btn" style="display: none;" onclick="showNextChallenge(15)">Next Challenge</button>
                </div>
            
			
			
			<!-- Challenge 16 -->
                <div id="challenge16" style="display: none;">
                   <h3>Postgresql Challenge</h3>
                    <p>Exploit Postgresql service on port 5432 and find the flag code.</p>
                    <div class="form-group">
                        <label for="flagCode16">Flag Code</label>
                        <input type="text" class="form-control" id="flagCode16" placeholder="Enter flag code">
                    </div>
                    <button class="submit-btn" onclick="submitFlag(16)">Submit Flag</button>
                    <button class="submit-btn" onclick="showPrevChallenge(16)">Previous Challenge</button>
                    <button id="nextChallengeBtn16" class="submit-btn" style="display: none;" onclick="showNextChallenge(16)">Next Challenge</button>
                </div>
            
			
			<!-- Challenge 17 -->
                <div id="challenge17" style="display: none;">
                   <h3>VNC Challenge</h3>
                    <p>Exploit VNC service on port 5900 and find the flag code.</p>
                    <div class="form-group">
                        <label for="flagCode17">Flag Code</label>
                        <input type="text" class="form-control" id="flagCode17" placeholder="Enter flag code">
                    </div>
                    <button class="submit-btn" onclick="submitFlag(17)">Submit Flag</button>
                    <button class="submit-btn" onclick="showPrevChallenge(17)">Previous Challenge</button>
                    <button id="nextChallengeBtn17" class="submit-btn" style="display: none;" onclick="showNextChallenge(17)">Next Challenge</button>
                </div>
            
			
			<!-- Challenge 18 -->
                <div id="challenge18" style="display: none;">
                   <h3>IRC Challenge</h3>
                    <p>Exploit IRC service on port 6667,6697 and find the flag code.</p>
                    <div class="form-group">
                        <label for="flagCode18">Flag Code</label>
                        <input type="text" class="form-control" id="flagCode18" placeholder="Enter flag code">
                    </div>
                    <button class="submit-btn" onclick="submitFlag(18)">Submit Flag</button>
                    <button class="submit-btn" onclick="showPrevChallenge(18)">Previous Challenge</button>
                    <button id="nextChallengeBtn18" class="submit-btn" style="display: none;" onclick="showNextChallenge(18)">Next Challenge</button>
                </div>
            
			
			
			<!-- Challenge 19 -->
                <div id="challenge19" style="display: none;">
                   <h3>http Challenge</h3>
                    <p>Exploit http service on port 8180 and find the flag code.</p>
                    <div class="form-group">
                        <label for="flagCode19">Flag Code</label>
                        <input type="text" class="form-control" id="flagCode19" placeholder="Enter flag code">
                    </div>
                    <button class="submit-btn" onclick="submitFlag(19)">Submit Flag</button>
                    <button class="submit-btn" onclick="showPrevChallenge(19)">Previous Challenge</button>
                    <button id="nextChallengeBtn19" class="submit-btn" style="display: none;" onclick="showNextChallenge(19)">Next Challenge</button>
                </div>
           
			
			
			<!-- Challenge 20 -->
                <div id="challenge20" style="display: none;">
                   <h3>DRB Challenge</h3>
                    <p>Exploit DRB service on port 8787 and find the flag code.</p>
                    <div class="form-group">
                        <label for="flagCode20">Flag Code</label>
                        <input type="text" class="form-control" id="flagCode20" placeholder="Enter flag code">
                    </div>
                    <button class="submit-btn" onclick="submitFlag(20)">Submit Flag</button>
                    <button class="submit-btn" onclick="showPrevChallenge(20)">Previous Challenge</button>
                    <button id="nextChallengeBtn20" class="submit-btn" style="display: none;" onclick="showNextChallenge(20)">Next Challenge</button>
                </div>
           
			
			
			
			
			




			 </div>
            </div>



            <div class="tab-content mt-3" id="walkthrough" style="display: none;">
                <h2>Walkthrough</h2>
                <p>This is the Walkthrough page.</p>
                <!-- Add explanations and solutions here -->
Walkthrogh here!
            </div>
        </div>
    </div> 
            </section><br><br><br>
        <?php else: ?>
            <!-- If not logged in, show login form -->
            <div id="loginForm" class="login-form">
                <h2>Login</h2>
                <?php if(isset($error)): ?>
                    <div class="alert alert-danger"><?php echo $error; ?></div>
                <?php endif; ?>
                <form action="index.php" method="post">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" value="<?php echo $defaultUsername; ?>">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" value="<?php echo $defaultPassword; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </form>
            </div>
        <?php endif; ?>
    </div>
    <footer>
        <p>&copy; 2024 Capture The Root (EVILXHACKER)</p>
    </footer>

    <script>
        var currentChallenge = <?php echo $_SESSION['completed_challenges']; ?>;

    function login() {
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        if (username === 'root' && password === 'password') {
            document.getElementById('loginForm').style.display = 'none';
            document.getElementById('navTabs').style.display = 'flex';
            document.getElementById('ctrChallenges').classList.add('active');
            document.getElementById('error').style.display = 'none';
        } else {
            document.getElementById('error').style.display = 'block';
        }
    }

        function showTab(tabId) {
            var tabs = document.getElementsByClassName('tab-content');
            for (var i = 0; i < tabs.length; i++) {
                tabs[i].style.display = 'none';
            }
            document.getElementById(tabId).style.display = 'block';
        }

        function submitFlag(challengeNumber) {
            var flagCode = document.getElementById('flagCode' + challengeNumber).value.trim();
            if (challengeNumber === 1 && flagCode === 'FLAG_CODE_FOR_CHALLENGE_1') {
                alert('Flag code correct! You can proceed to the next challenge.');
                document.getElementById('flagCode1').disabled = true;
                document.getElementById('nextChallengeBtn1').style.display = 'inline-block';
            } else if (challengeNumber === 2 && flagCode === 'FLAG_CODE_FOR_CHALLENGE_2') {
                alert('Flag code correct! You can proceed to the next challenge.');
                document.getElementById('flagCode2').disabled = true;
                document.getElementById('nextChallengeBtn2').style.display = 'inline-block';
            } else if (challengeNumber === 3 && flagCode === 'FLAG_CODE_FOR_CHALLENGE_3') {
                alert('Flag code correct! You can proceed to the next challenge.');
                document.getElementById('flagCode3').disabled = true;
                document.getElementById('nextChallengeBtn3').style.display = 'inline-block';
            } else if (challengeNumber === 4 && flagCode === 'FLAG_CODE_FOR_CHALLENGE_4') {
                alert('Flag code correct! You can proceed to the next challenge.');
                document.getElementById('flagCode4').disabled = true;
                document.getElementById('nextChallengeBtn4').style.display = 'inline-block'; 
            } else if (challengeNumber === 5 && flagCode === 'FLAG_CODE_FOR_CHALLENGE_5') {
                alert('Flag code correct! You can proceed to the next challenge.');
                document.getElementById('flagCode5').disabled = true;
                document.getElementById('nextChallengeBtn5').style.display = 'inline-block'; 
            } else if (challengeNumber === 6 && flagCode === 'FLAG_CODE_FOR_CHALLENGE_6') {
                alert('Flag code correct! You can proceed to the next challenge.');
                document.getElementById('flagCode6').disabled = true;
                document.getElementById('nextChallengeBtn6').style.display = 'inline-block'; 
            }else if (challengeNumber === 7 && flagCode === 'FLAG_CODE_FOR_CHALLENGE_7') {
                alert('Flag code correct! You can proceed to the next challenge.');
                document.getElementById('flagCode7').disabled = true;
                document.getElementById('nextChallengeBtn7').style.display = 'inline-block'; 
            }else if (challengeNumber === 8 && flagCode === 'FLAG_CODE_FOR_CHALLENGE_8') {
                alert('Flag code correct! You can proceed to the next challenge.');
                document.getElementById('flagCode8').disabled = true;
                document.getElementById('nextChallengeBtn8').style.display = 'inline-block'; 
            }else if (challengeNumber === 9 && flagCode === 'FLAG_CODE_FOR_CHALLENGE_9') {
                alert('Flag code correct! You can proceed to the next challenge.');
                document.getElementById('flagCode9').disabled = true;
                document.getElementById('nextChallengeBtn9').style.display = 'inline-block'; 
            }else if (challengeNumber === 10 && flagCode === 'FLAG_CODE_FOR_CHALLENGE_10') {
                alert('Flag code correct! You can proceed to the next challenge.');
                document.getElementById('flagCode10').disabled = true;
                document.getElementById('nextChallengeBtn10').style.display = 'inline-block'; 
            }else if (challengeNumber === 11 && flagCode === 'FLAG_CODE_FOR_CHALLENGE_11') {
                alert('Flag code correct! You can proceed to the next challenge.');
                document.getElementById('flagCode11').disabled = true;
                document.getElementById('nextChallengeBtn11').style.display = 'inline-block'; 
            }else if (challengeNumber === 12 && flagCode === 'FLAG_CODE_FOR_CHALLENGE_12') {
                alert('Flag code correct! You can proceed to the next challenge.');
                document.getElementById('flagCode12').disabled = true;
                document.getElementById('nextChallengeBtn12').style.display = 'inline-block'; 
            }else if (challengeNumber === 13 && flagCode === 'FLAG_CODE_FOR_CHALLENGE_13') {
                alert('Flag code correct! You can proceed to the next challenge.');
                document.getElementById('flagCode13').disabled = true;
                document.getElementById('nextChallengeBtn13').style.display = 'inline-block'; 
            }else if (challengeNumber === 14 && flagCode === 'FLAG_CODE_FOR_CHALLENGE_14') {
                alert('Flag code correct! You completed all challenges.');
                document.getElementById('flagCode14').disabled = true;
                document.getElementById('nextChallengeBtn14').style.display = 'inline-block'; 
            }else if (challengeNumber === 15 && flagCode === 'FLAG_CODE_FOR_CHALLENGE_15') {
                alert('Flag code correct! You can proceed to the next challenge.');
                document.getElementById('flagCode15').disabled = true;
                document.getElementById('nextChallengeBtn15').style.display = 'inline-block'; 
            }else if (challengeNumber === 16 && flagCode === 'FLAG_CODE_FOR_CHALLENGE_16') {
                alert('Flag code correct! You can proceed to the next challenge.');
                document.getElementById('flagCode16').disabled = true;
                document.getElementById('nextChallengeBtn16').style.display = 'inline-block'; 
            }else if (challengeNumber === 17 && flagCode === 'FLAG_CODE_FOR_CHALLENGE_17') {
                alert('Flag code correct! You can proceed to the next challenge.');
                document.getElementById('flagCode17').disabled = true;
                document.getElementById('nextChallengeBtn17').style.display = 'inline-block'; 
            }else if (challengeNumber === 18 && flagCode === 'FLAG_CODE_FOR_CHALLENGE_18') {
                alert('Flag code correct! You can proceed to the next challenge.');
                document.getElementById('flagCode18').disabled = true;
                document.getElementById('nextChallengeBtn18').style.display = 'inline-block'; 
            }else if (challengeNumber === 19 && flagCode === 'FLAG_CODE_FOR_CHALLENGE_19') {
                alert('Flag code correct! You can proceed to the next challenge.');
                document.getElementById('flagCode19').disabled = true;
                document.getElementById('nextChallengeBtn19').style.display = 'inline-block'; 
            }else if (challengeNumber === 20 && flagCode === 'FLAG_CODE_FOR_CHALLENGE_20') {
        alert('Flag code correct! You completed all challenges.');
        document.getElementById('flagCode20').disabled = true;
        document.getElementById('nextChallengeBtn20').style.display = 'none';  // No next challenge for the fourth challenge

        // Redirect the user to the congratulations page
        window.location.href = 'congratulations.html'; // Replace 'congratulations.html' with the URL of your congratulations page
        return; // Stop further execution of the function
    }
			else {
                alert('Incorrect flag code. Please try again.');
            }
        }


        function showNextChallenge(challengeNumber) {
            if (currentChallenge < 20) {
                currentChallenge++;
                document.getElementById('challenge' + currentChallenge).style.display = 'block';
                document.getElementById('challenge' + (currentChallenge - 1)).style.display = 'none';
            }
        }

        function showPrevChallenge(challengeNumber) {
            if (currentChallenge > 1) {
                currentChallenge--;
                document.getElementById('challenge' + currentChallenge).style.display = 'block';
                document.getElementById('challenge' + (currentChallenge + 1)).style.display = 'none';
            }
        }
		
		
		function redirectToSetupPage() {
    window.location.href = 'setup.html'; // Replace 'setup.html' with the URL of your setup page
}

		
    </script>
</body>
</html>
