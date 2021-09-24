const tweetList = document.querySelector('.tweet-list');   // OK
const textArea = document.getElementById('text-area');    // OK

show_All_tweets();

function Manage_data (data){

  if (data.Empty != undefined)  
  {      
         Manage_html_Empty(data.Empty);
  }
  else
  {
    let id = [];
    let content = [];

    data.Tweets.forEach(tweet => {

      id.push(tweet.id);
      content.push(tweet.content);
    })
    
      Manage_html(id,content);
  }

}

function Manage_html_Empty (data){
  
  tweetList.innerHTML = '';
  tweetList.innerHTML = `
  <div class="card empty" style="width: 18rem;">
    <div class="card-body">
      <h5 class="card-title">Tweet Content</h5>
      <p class="card-text"><b>${data}</b></p>
    </div>
  </div>
`;    

}

function Manage_html (id,content){
  
  tweetList.innerHTML= '';
  
  for (let index = 0; index < id.length; index++) {
    
    tweetList.innerHTML += `
    <div class="card Two" style="width: 25rem;">
      <div class="card-body Three">   
        <h5 class="card-title">Tweet Content</h5>
          <p class="card-text"><b>${content[index]}</b></p>
          <button  class="btn btn-primary update" onclick = "editTweet(event,${id[index]})" type="submit" id="edit-Tweet">Edit</button>
          <button  class="btn btn-primary save" onclick = "update_Tweet(event,${id[index]})"  type="submit" id="Save-Tweet">Save</button>
          <button  class="btn btn-primary " onclick = "deleteTweet(event,${id[index]})" type="submit" id="delete-Tweet">Delete</button>
          <button  class="btn btn-primary " data-con =${content[index]} id = "showCom" onclick = "showComments(event,${id[index]})">Comments</button>
      </div>
    </div>
    `;
  }  
}

//----------------------------------Show All Tweets----------------------------------------------                                   

function show_All_tweets(){
   
    document.querySelector('.text-area').value='';
    fetch('http://localhost:8080/tweet/get/all')
    .then(res => res.json())
    .then(data =>  { Manage_data(data)})
}

//----------------------------------Create Tweet----------------------------------------------                 

function createTweet(event){

    event.preventDefault();
    
    fetch('http://localhost:8080/tweet' , { method: 'POST' , headers: { 'content-Type': 'application/json' } , body: JSON.stringify ({  content : textArea.value })  })
    .then(res => res.json())

    document.querySelector('.text-area').value='';
    window.location.reload();
    show_All_tweets();
}

//----------------------------------Remove Tweet----------------------------------------------       

function deleteTweet(event , id){

    event.preventDefault();
  
    fetch('http://localhost:8080/tweet/delete/'+id , { method: 'delete' })
    .then(res => res.json())
    window.location.reload();
    show_All_tweets();
}

//----------------------------------update Tweet----------------------------------------------  

function editTweet(event ,id){

    event.preventDefault();

    update = event.target.parentElement.querySelector('.update');
    save = event.target.parentElement.querySelector('.save');         

    update.style.display = 'none'; 
    save.style.display = 'inline'; 
  
    ex_content =  event.target.parentElement.querySelector('.card-text').textContent;   
    textArea.value = ex_content;
}


function update_Tweet(event,id){  

    event.preventDefault();

    fetch('http://localhost:8080/tweet/update/'+id , { method: 'PATCH' , headers: { 'content-Type': 'application/json' } , body:JSON.stringify({  content : textArea.value })  })
    .then(res => res.json())
    window.location.reload();
    show_All_tweets();

    document.querySelector('.text-area').value='';
}


















//----------------------------------Show Comments-------------------------------------------------------------------------------------------------------------------------------------------//        

function print_Box(con,id){

  tweetList.innerHTML = '';  
  
  tweetList.innerHTML = `
      
    <div class="container">
                          
      <br>
         <h5 class="card-subtitle mb-2 text-muted">Tweet Content </h5>
         <p class="card-text"><b>${con}</b></p>              
      <br>
     
                 
      <form class="row g-2">

        <div class="col-auto NOW" >
           
          <input type="text" class='form-control' placeholder="Enter your Comment" id="add" />

        </div>    
           
        <div class="col-auto" >
           
          <button type="button" class="btn btn-success mr-sm-2" onclick = "addComment(event,${id})" id="addCommentbtn"> Add Comment </button>
           
        </div>  

      </form>  

    </div>
     
  `;
   
}

function Manage_Comment_Data (data,id){
  
  if (data.Empty != undefined)  
  {      
       Manage_Comment_Empty(data.Empty);
  }
  else
  {
    let id_Arr = [];
    let content = [];
    
    data.Comments.forEach(tweet => {
      id_Arr.push(tweet.id);
      content.push(tweet.content);
    })
   
    Manage_Comment_html(id_Arr,content,id);
  }

}

function Manage_Comment_Empty (data)
{
  let existingHtml = tweetList.innerHTML;

   tweetList.innerHTML = existingHtml + `
   
  <div class="card empty" style="width: 18rem; margin-top:1rem; margin-left: 28%;">
    <div class="card-body">
      <h5 class="card-title">Comment Content</h5>
      <p class="card-text"><b>${data}</b></p>
    </div>
  </div>
`;

}

function Manage_Comment_html(id,content,tweet_id){
   
  let existingHTML = '';
  existingHTML = tweetList.innerHTML;

  existingHTML +=`
  
  <table class="table" style = "margin-top: 20px;">
  
    <thead>
      <tr>
        <th scope="col"> id</th>
        <th scope="col">tweet_id</th>
        <th scope="col">content</th>
        <th scope="col"></th>
        <th scope="col"></th>
        <th scope="col"></th>
      </tr>
    </thead>   
    
    <tbody>`;

  for (let index = 0; index < id.length; index++) {
    existingHTML += `
      <tr>
        <td scope="row">${id[index]}</td>
        <td>${tweet_id}</td>
        <td  class = "cont">${content[index]}</td>
        <td>   
          <button type="button" class="btn btn-success mr-sm-2 updateComment" onclick = "editComment(event,${id[index]})" id="editCommentbtn"> Edit Comment </button>
          <button type="button" class="btn btn-success mr-sm-2 lala" onclick = "update_Comment(event,${id[index]})" id="SaveCommentbtn"> Save Comment </button>
        </td>
        <td>  <button type="button" class="btn btn-success mr-sm-2" onclick = "deleteComment(event,${id[index]})" id="deleteCommentbtn"> Delete Comment </button></td>
      </tr>
           
  `;
}
existingHTML += `</tbody> </table>`;

tweetList.innerHTML = existingHTML; 

}

function showComments(event,id){
    
    event.preventDefault();
    
    fetch('http://localhost:8080/tweet/get/Comments/'+id)
    .then(res => res.json())
    .then(data =>  { 
      
      if (event.target.id=='showCom') {
      print_Box(event.target.dataset.con,id);Manage_Comment_Data(data,id);}
      else{
      print_Box(document.querySelector('.card-text').textContent,id); Manage_Comment_Data(data,id)} })
}

//----------------------------------create Comment----------------------------------------------                                   

function addComment(event,id){
  
    event.preventDefault();

    content1 = document.getElementById('add').value; 
    
    fetch('http://localhost:8080/comment/'+id , { method: 'POST' , headers: { 'content-Type': 'application/json' } , body:JSON.stringify({ content : content1 }) })
    .then(res => res.json())
    showComments(event,id); 
}

//----------------------------------delete Comment----------------------------------------------                                   
/*
function deleteComment(event,id){

  Com = 'DELETE';
  event.preventDefault();
  tweet_id = event.target.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector('.container').id;
  
  fetch('http://localhost:8080/comment/delete/'+id , { method: 'delete' })
  .then(res => res.json())
  .then(data => Show(data))
}

//----------------------------------edit Comment----------------------------------------------                                   

function editComment(event,id){
 
  Com = 'EDIT';
  event.preventDefault();

  let form = document.querySelector('.form-control');

  console.log(form.value = 'Hello');

  tweet_id = event.target.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector('.container').id;

  update = event.target.parentElement.querySelector('.updateComment');
  save = event.target.parentElement.parentElement.querySelector('.lala');

  update.style.display = 'none'; 
  save.style.display = 'inline'; 

  ex_content =  event.target.parentElement.parentElement.querySelector('.cont').textContent;
   form = event.target.parentElement.parentElement.parentElement.parentElement.parentElement.querySelector('.form-control');
  form.value = ex_content;  
}


function update_Comment(event,id){
Com = 'EDIT';
  event.preventDefault();

                      fetch('http://localhost:8080/comment/update/'+id , {
                        method: 'PATCH' ,
                        headers: {
                          'content-Type': 'application/json'
                        },
                        body:JSON.stringify({ 
                          
                            content :  form.value
                          
                          })

                      })
                      .then(res => res.json())
                     
                      .then(data =>  {
                            
                            Show(data);
                        
                        }) 
  
}

*/