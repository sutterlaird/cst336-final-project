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