const base_URL = "http://localhost/FullStackProject-Web/Back%20End/";
const base_HTML = "http://localhost/FullStackProject-Web/Front%20End/";

const workshop_pages = {};

workshop_pages.loadFor = (page) => {
    eval("workshop_pages.load_" + page + "();");
}

workshop_pages.load_login = () => {
    const btn_login = document.getElementById('btn_login');
    let input_username = document.getElementById('input_username');
    let input_pass = document.getElementById('input_pass');

    const login = async () => {//login post user name and password returns all info needed about the username 
        let list = {};
        var bodyFormData = new FormData();
        bodyFormData.append('Username', input_username.value);
        bodyFormData.append('Password', input_pass.value);
        await axios({
            method: "post",
            url: "http://localhost/FullStackProject-Web/Back%20End/login.php",
            data: bodyFormData,
            headers: { "Content-Type": "multipart/form-data" },
          })
        .then(function(response){
             list = response.data;
        })
        .catch(function(error) {
            console.log(error);
        });     
        if(list["success"] == "true"){
            //adding values to local stoarge
            localStorage.setItem("FName", list["0"]["FName"]);
            localStorage.setItem("LName", list["0"]["LName"]);
            localStorage.setItem("Username", list["0"]["Username"]);
            localStorage.setItem("User_id", list["0"]["User_id"]);
            //moving to homepage
            location.replace(base_HTML+"homePage.html");
        }
        else{
            document.getElementById("check").innerHTML = "Wrong username or password";
        }
    };  
    btn_login.addEventListener('click', login);
}

workshop_pages.load_homePage = () => {
    const posts = document.getElementById('elements');
    const append = '<div id="elements">'+
    '<div class="grid-item">'+
        '<div class="card">'+
            '<img class="card-img" src="img1.jpg" />'+
            '<div class="card-content">'+
                '<h1 class="card-header">Orange </h1>'+
                '<button id="btn_comment" class="card-btn comment">Comments <button id="btn_like"'+
                        'class="card-btn like">Likes 0 </button> </button>'+
                '</div>'+
            '</div>'+
        '</div>'+
    '</div>'

    const append2 = '<div id="elements">'+
    '<div class="grid-item">'+
        '<div class="card">'+
            '<img class="card-img" src="img2.jpg" />'+
            '<div class="card-content">'+
                '<h1 class="card-header">Orange </h1>'+
                '<button id="btn_comment" class="card-btn comment">Comments <button id="btn_like"'+
                        'class="card-btn like">Likes 0 </button> </button>'+
                '</div>'+
            '</div>'+
        '</div>'+
    '</div>'

    const list2 = [append + append2]
    posts.innerHTML = list2;
}


// const getData = () => {
//     axios.get(base_URL + "get_images.php").then(response =>{
//         console.log(response.data);
//     })
// };
//btn_login.addEventListener('click', getData("test", "test"));
//postBtn.addEventListener('click', sendData);