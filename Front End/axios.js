


window.onload = () => {


const btn_login = document.getElementById('btn_login');

let input_username = document.getElementById('input_username');
let input_pass = document.getElementById('input_pass');
// 
// const postBtn = document.getElementById('post-btn');
// const base_URL = "http://localhost/FullStackProject-Web/Back%20End/";


const test = () => {
    console.log("IAM BEING CLICKED")
}

btn_login.addEventListener('click', test());



/*
const getData = () => {
    axios.get(base_URL + "get_images.php").then(response =>{
        console.log(response.data);
    })
};

const login = (username, password) => {
    var bodyFormData = new FormData();
    bodyFormData.append('Username', username);
    bodyFormData.append('Password', password);

    axios({
        method: "post",
        url: "http://localhost/FullStackProject-Web/Back%20End/login.php",
        data: bodyFormData,
        headers: { "Content-Type": "multipart/form-data" },
      })
    .then(function(response){
        console.log(response);
    })
    .catch(function(error) {
        console.log(error);
      }); //needs User_id, Image_URL
};
*/

//btn_login.addEventListener('click', getData("test", "test"));
//postBtn.addEventListener('click', sendData);
}