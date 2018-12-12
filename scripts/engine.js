// Global variables to handle login functions
var loggedIn = false;
var userId;








// Runs at load and checks if already logged in
function checkLogin() {
    var userData = {
        requestType: "checkLogin",
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
                userId = data['user_id'];
                $("#loginBar").html("Logged in as " + data['username'] + "  " + $("#logoutButtonDiv").html());
                $("#profileLink").removeClass("d-none");
            }
            else {
                $("#loginBar").html($("#loginBarButtons").html());
            }
        })
        .fail(function(xhr, status, errorThrown) {
            console.log("error", xhr.responseText);
        });
}






// clearPage clears the content area of the page
function clearPage() {
    $("#contentArea").html("");
}








// buildHomepage adds the homepage code to the content area
function buildHomepage() {
    clearPage();
    checkLogin();
    $("#contentArea").append($("#home").html())
}





// buildProfilePage adds the homepage code to the content area
function buildProfilePage() {
    clearPage();
    $("#contentArea").append($("#profile").html())
    
     var userData = {
        requestType: "getProfile",
    };
    $.ajax({
            url: "api.php",
            type: "POST",
            dataType: "json",
            contentType: "application/json",
            data: JSON.stringify(userData)
        })
        .done(function(data) {
            $("#profileUsername").val(data['username']);
            $("#profileFirstName").val(data['firstname']);
            $("#profileLastname").val(data['lastname']);
            $("#profileEmail").val(data['email']);
            $("#profilePhone").val(data['phone']);
            $("#profileAddress").val(data['address']);
        })
        .fail(function(xhr, status, errorThrown) {
            console.log("error", xhr.responseText);
        });
}






function updateProfile() {
    var userData = {
        requestType: "updateProfile",
        firstname: $("#profileFirstName").val(),
        lastname: $("#profileLastname").val(),
        phone: $("#profilePhone").val(),
        email: $("#profileEmail").val(),
        address: $("#profileAddress").val()
    };
    $.ajax({
            url: "api.php",
            type: "POST",
            dataType: "json",
            contentType: "application/json",
            data: JSON.stringify(userData)
        })
        .done(function(data) {
            alert("SHIT IS DONE DUDE");
        })
        .fail(function(xhr, status, errorThrown) {
            console.log("error", xhr.responseText);
        });
    
}





// buildKitPage checks if logged in before either opening the login modal or loading the kit page
function buildKitPage() {
    clearPage();
    if (!loggedIn) {
        showLoginModal(function() {
            kitPageWork();
        });
    }
    else {
        kitPageWork();
    }
}








// kitPageWork handles loading the kit page code into the content area and checking the appropriate checkboxes
function kitPageWork() {
    $("#kitUpdateMsg").addClass("d-none");
    var userData = {
        requestType: "getKit",
        userId: userId
    }
    
    $.ajax({
            url: "api.php",
            type: "POST",
            dataType: "json",
            contentType: "application/json",
            data: JSON.stringify(userData)
    })
    .done(function(data) {
        $("#contentArea").append($("#myKit").html());
        for (var key in data) {
            $("#" + data[key].shortname + "Check").prop("checked", "true");
        }
    })
    .fail(function(xhr, status, errorThrown) {
        console.log("error", xhr.responseText);
    });
}








// setKit updates the DB when the update button is pressed on the kit page
function setKit() {
    var checkedItems = new Array();
    var uncheckedItems = new Array();
    $("#contentArea input:checkbox[name=items]").each(function(){
        if ($(this).prop("checked")) {
            checkedItems.push($(this).val());
        }
        else {
            uncheckedItems.push($(this).val());
        }
    });
    
    var userData = {
        requestType: "setKit",
        userId: userId,
        checkedItems: checkedItems,
        uncheckedItems: uncheckedItems
    }
    
    $.ajax({
            url: "api.php",
            type: "POST",
            dataType: "json",
            contentType: "application/json",
            data: JSON.stringify(userData)
    })
    .done(function(data) {
        if (data['statusCode'] == 0) {
            console.log("Kit Updated Successfully");
            $("#kitUpdateMsg").removeClass("d-none");
        }
        else {
            console.log("YOU FAILED");
        }
    })
    .fail(function(xhr, status, errorThrown) {
        console.log("error", xhr.responseText);
    });
}








// buildMapPage adds the map page's code to the content area
function buildMapPage() {
    clearPage();
    $("#contentArea").append($("#disasterMap").html())
}








// showLoginModal opens the login modal and verifies the account, with an optional callback argument to execute a function after login is finished
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
                userId = data['user_id'];
                
                $("#loginModal").modal("hide");
                $("#loginBar").html("Logged in as " + userData.username + "  " + $("#logoutButtonDiv").html());
                $("#profileLink").removeClass("d-none");
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








// showSignupModal opens the signup modal and creates the account
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
                $("#profileLink").removeClass("d-none");
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








// Log Out
function logOut() {
    var userData = {
        requestType: "logOut"
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
            loggedIn = false;
            userId = "";
            $("#loginBar").html($("#loginBarButtons").html());
            buildHomepage();
            $("#profileLink").addClass("d-none");
        }
    })
    .fail(function(xhr, status, errorThrown) {
        console.log("error", xhr.responseText);
    });
}