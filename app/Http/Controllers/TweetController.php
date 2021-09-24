<?php

require_once(__DIR__ . "/../../Models/Tweet.php");


class TweetController extends Controller
{

    public function CreateTweet(Request $request){
    
        $body = json_decode($request->content);

        if(isset($body->content) && !empty($body->content)){

            $id =  Tweet::create(["content"=> $body->content]);
            $id = array($id);
            
            return Response::json(["Message"=> "The tweet is created successfully" ,"Tweets"=> $id] , Response::HTTP_OK , 0);
        }
        else
            return Response::json( ["Empty"=> "Body of the Tweet Is Not Provided Correctly"]  , Response::HTTP_BAD_REQUEST );
    }


    public function deleteTweet(Request $request, $id){
        
        if(!empty($id)){
            
            $inside = Tweet::first("id" , $id);
            
            if(!empty($inside)){
                
                if($inside->destroy( "id", "=" , $id))

                    $inside = array($inside);
                    return Response::json(["Message"=> "The tweet is deleted successfully" ,"Tweets"=> $inside] , Response::HTTP_OK , 0);          
            }
            else 
                return Response::json( ["Empty"=> "Tweet id provided does not exist in the database"]  , Response::HTTP_BAD_REQUEST );
        }    
        else
            return Response::json( ["Empty"=> "Tweet id not provided"]  , Response::HTTP_BAD_REQUEST );
    }


    public function getAllTweets(Request $request){     

        
        $inside = Tweet::all();  
        
      
        if(!empty($inside)){ 

            return Response::json( ["Tweets"=>$inside] , Response::HTTP_OK , 0);
        }
        else
            return Response::json( ["Empty"=> "There Are No Tweets"]  , Response::HTTP_BAD_REQUEST); 
            
    }


    public function updateTweet(Request $request,$id){
     
        $body = json_decode($request->content);   

        if(!empty($id)){

            $inside = Tweet::first("id", $id);

            if (!empty($inside) && isset($body->content) &&  !empty($body->content)){
        
                $inside->content = $body->content;
                $inside->save(); 
                $inside = array($inside);
                return Response::json(["Message"=> "The tweet is updated successfully" , "Tweets"=>$inside] , Response::HTTP_OK , 0);          
            }
            else 
                return Response::json( ["Empty"=> "The body of the tweet is not provided"]  , Response::HTTP_BAD_REQUEST );
        }
        else
            return Response::json( ["Empty"=> "Tweet id not provided"]  , Response::HTTP_BAD_REQUEST );
    }

   
    public function getComments(Request $request,$id){

        if(!empty($id)){

            $result = Tweet::first("id" , $id);
            
            if(!empty($result)){

                $comm = $result->comments();
                
                if (!empty($comm))
                    return Response::json(["Comments"=> $comm] , Response::HTTP_OK , 0);
                else
                    return Response::json( ["Empty"=> "There are no comments for this tweet"]  , Response::HTTP_BAD_REQUEST );   
            }
            else 
                return Response::json( ["Empty"=> "There is no such tweet in the database"]  , Response::HTTP_BAD_REQUEST );   
        }
        else
            return Response::json( ["Empty"=> "Id not provided"]  , Response::HTTP_BAD_REQUEST );    
    }

    // NOT USED
    public function getTweet(Request $request,$id){
    
        if(!empty($id)){
            
            $inside = Tweet::first("id" , $id);

            if (!empty($inside))      
                return Response::json($inside , Response::HTTP_OK , 0 );          
            else 
                return Response::json( ["Message"=> "Tweet id provided does not exist in the database"]  , Response::HTTP_BAD_REQUEST );
        }
        else 
            return Response::json( ["Empty"=> "Tweet id not provided"]  , Response::HTTP_BAD_REQUEST );
    }

    // NOT USED
    public function home (Request $request){

        $app = Env::get('APP_NAME');
        return new View('Tweet.php',compact('app'));
    }
}
    