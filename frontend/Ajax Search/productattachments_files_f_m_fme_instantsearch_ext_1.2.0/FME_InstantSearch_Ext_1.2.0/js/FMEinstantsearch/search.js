var Instantsearch = Class.create();
var searchInput = '';
Instantsearch.prototype = {
    initialize: function(Url, searchInput){
		this.searchInput = searchInput;
        this.Url = Url;	
				
		this.onSuccess = this.onSuccess.bindAsEventListener(this);        
		this.onFailure = this.onFailure.bindAsEventListener(this);				
	    
		
    },
    search: function(){	
		 
		
		var searchval = $(this.searchInput);
	    
		
	    this.currentSearch = searchval.value;
		
		searchval.className =  'loading input-text';
		var keyword = searchval.value;
		
		url = this.Url;
		
		var parameters = {q: keyword};
		
		new Ajax.Request(url, {
			  method: 'post',	
			  parameters: parameters,
		      onSuccess: this.onSuccess,
			  onFailure: this.onFeailure 
		  });	
		 
		 
    },
    onFailure: function(transport){
       searchval.className ="input-text";
    },
	
	
	onSuccess: function(transport)
	{ 
		
		$('search').className ="input-text";
                response = transport.responseText; 
                $('searchcontent').update(response);
                $('searchcontent').innerHTML; 
                
           
			
						
		
		
		 this.doneWorking();		
	}

}
function   getpro(id,url) {
	
		
		var parameters = {id: id};

		$$('.active').invoke('removeClassName', 'active');
		$('is-'+id).className ='active';
		
		new Ajax.Request(url, {
			  method: 'post',	
			  parameters: parameters,
		      onFailure: function(response){
     
    },
	
	
	onSuccess: function(response)
	{ 
		
		
                response = response.responseText; 
                $('currproduct').update(response);
                $('currproduct').innerHTML; 
               
           
			
						
		
		
		 this.doneWorking();		
	}
		  });	

		


}
function addtocart(url,key)
{
var qty=$('qty').value; 
window.location=url+'/qty/'+qty+'/'+key;
}
function removedd()
{ 
 $('searchcontent').update('&nbsp;');
                $('searchcontent').innerHTML; 
}