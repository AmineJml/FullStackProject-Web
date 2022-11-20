const getBtn = document.getElementById('get-btn');
const postBtn = document.getElementById('post-btn');
const base_URL = "http://localhost/FullStackProject-Web/Back%20End/";
const getData = () => {
    axios.get(base_URL + "get_images.php").then(response =>{
        console.log(response.data);
    })
};


async function axiosTest() {
    const response = await axios.get(url)
    return response.data
}
const sendData = () => {
    var bodyFormData = new FormData();
    bodyFormData.append('Username', 'test');
    bodyFormData.append('Password', 'test');

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

getBtn.addEventListener('click', getData);
postBtn.addEventListener('click', sendData);
