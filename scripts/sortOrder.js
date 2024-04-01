window.onpopstate = function(e) {
    window.location.href = "/admin.php";
}

$(document).ready(function() {
    console.log(sortMethod);
    switch (sortMethod) {
        case 'lname asc,fname asc':
            document.getElementById("names").innerHTML = 
            `<a class="sortButton" href="/sessioninfo.php?sortType=lname+desc%2Cfname+desc&id=${id}">Name</a><img id="arrows" src="/images/downarrow.png">`;
            break;
        case 'lname desc,fname desc':
            document.getElementById("names").innerHTML = 
            `<a class="sortButton" href="/sessioninfo.php?sortType=lname+asc%2Cfname+asc&id=${id}">Name</a><img id="arrows" src="/images/uparrow.png">`;
            break;
        case 'id asc':
            document.getElementById("tickets").innerHTML = 
            `<a class="sortButton" href="/sessioninfo.php?sortType=id+desc&id=${id}">Ticket #</a><img id="arrows" src="/images/downarrow.png">`;
            break;
        case 'id desc':
            document.getElementById("tickets").innerHTML = 
            `<a class="sortButton" href="/sessioninfo.php?sortType=id+asc&id=${id}">Ticket #</a><img id="arrows" src="/images/uparrow.png">`;
            break;
        case 'email asc':
            document.getElementById("emails").innerHTML = 
            `<a class="sortButton" href="/sessioninfo.php?sortType=email+desc&id=${id}">Email</a><img id="arrows" src="/images/downarrow.png">`;
            break;
        case 'email desc':
            document.getElementById("emails").innerHTML = 
            `<a class="sortButton" href="/sessioninfo.php?sortType=email+asc&id=${id}">Email</a><img id="arrows" src="/images/uparrow.png">`;
            break;
        case 'referral asc':
            document.getElementById("referrals").innerHTML = 
            `<a class="sortButton" href="/sessioninfo.php?sortType=referral+desc&id=${id}">Referred By</a><img id="arrows" src="/images/downarrow.png">`;
            break;
        case 'referral desc':
            document.getElementById("referrals").innerHTML = 
            `<a class="sortButton" href="/sessioninfo.php?sortType=referral+asc&id=${id}">Referred By</a><img id="arrows" src="/images/uparrow.png">`;
            break;
        default:
            break;
    }
    history.pushState({}, '', location.href);
});