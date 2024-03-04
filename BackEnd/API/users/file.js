async function nameData() {
    let data = await fetch('http://localhost/PHP_44/PHP_Project_ITI/BackEnd/API/users/allUsers.php');

    let users = data.json();
    users.then(function (users) {
        console.log(users);
    })
}

nameData();