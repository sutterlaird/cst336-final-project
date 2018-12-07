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
    $("#contentArea").append($("#myKit").html())
}



function showLoginModal() {
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
            }
            else {
                console.log("Login failed");
                
            }
        })
        .fail(function(xhr, status, errorThrown) {
            console.log("error", xhr.responseText);
        });
                
    });
}