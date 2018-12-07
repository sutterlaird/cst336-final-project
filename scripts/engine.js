var loggedIn = false;
var userId;

function clearPage() {
    $("#contentArea").html("");
}

function buildHomepage() {
    clearPage();
    $("#contentArea").append($("#home").html())
}

function buildKitPage() {
    clearPage();
    if (!loggedIn) {
        showLoginModal(function() {
            $("#contentArea").append($("#myKit").html());
        });
    }
}

function buildMapPage() {
    clearPage();
    $("#contentArea").append($("#disasterMap").html())
}

function showLoginModal(callback) {
    $("#loginModal").modal("show");
    
    
    $("#loginButton").click(function() {
        
        
        var userData = {
            requestType: "login",
            username: $("#logInUsername").val(),
            password: $("#logInPassword").val()
        };
        $.ajax({
            url: "api.php",
            type: "POST",
            dataType: "json",
            contentType: "application/json",
            data: JSON.stringify(userData)
        })
        .done(function(data) {
            if (data['statusCode'] == 0) {
                console.log("login was successful");
                loggedIn = true;
                
                $("#loginModal").modal("hide");
                $("#loginBarButton").hide();
                $("#loginBar").html("Logged in as " + userData.username + "  ");
                if (callback) {
                    callback();
                }
            }
            else {
                $("#loginFailureMsg").removeClass("d-none");
                console.log("Login failed");
                $("#logInUsername").change(function() {
                    $("#loginFailureMsg").addClass("d-none");
                });
                $("#logInPassword").click(function() {
                    $("#loginFailureMsg").addClass("d-none");
                });
            }
        })
        .fail(function(xhr, status, errorThrown) {
            console.log("error", xhr.responseText);
        });
                
    });
}




function showSignupModal() {
    $("#signupModal").modal("show");
    
    $("#signupButton").click(function() {
        
        var userData = {
            requestType: "signup",
            username: $("#signUpUsername").val(),
            password: $("#signUpPassword").val()
        };
        $.ajax({
            url: "api.php",
            type: "POST",
            dataType: "json",
            contentType: "application/json",
            data: JSON.stringify(userData)
        })
        .done(function(data) {
            if (data['statusCode'] == 0) {
                alert("Account " + userData.username + " was created successfully!");
                console.log("signup was successful");
                loggedIn = true;
                
                $("#signupModal").modal("hide");
                $("#signupBarButton").hide();
                $("#loginBar").html("Logged in as " + userData.username + "  ");
            }
            else {
                alert("Account creation failed!");
                console.log("Signup failed");
            }
        })
        .fail(function(xhr, status, errorThrown) {
            console.log("error", xhr.responseText);
        });
                
    });
}