var skeletonId = 'skeleton';
var contentId = 'content';
var skipCounter = 0;
var takeAmount = 10;


function getRequests(mode) {
  $('#content').empty();
  SimpleAjax('/sent-requests', 'GET', sentRequestOnSuccess);
}

function getRecievedRequest(){
  $('#content').empty();
  SimpleAjax('/recieved-requests', 'GET', recievedRequestOnSuccess);
}

function getMoreRequests(mode) {
  // Optional: Depends on how you handle the "Load more"-Functionality
  // your code here...
}

function getConnections() {
  $('#content').empty();
  SimpleAjax('/connections', 'GET', connectionOnSuccess);
  
}

function getMoreConnections() {
  // Optional: Depends on how you handle the "Load more"-Functionality
  // your code here...
}

function getConnectionsInCommon(userId, connectionId) {
  // your code here...
}

function getMoreConnectionsInCommon(userId, connectionId) {
  // Optional: Depends on how you handle the "Load more"-Functionality
  // your code here...
}

function getSuggestions() {
  $('#content').empty();
  SimpleAjax('/suggestions', 'GET', suggestionOnSuccess);
}

function getMoreSuggestions() {
  // Optional: Depends on how you handle the "Load more"-Functionality
  // your code here...
}

function sendRequest(userId, suggestionId) {
  // your code here...
}

function deleteRequest(userId, requestId) {
  // your code here...
}

function acceptRequest(userId, requestId) {
  // your code here...
}

function removeConnection(userId, connectionId) {
  // your code here...
}


function suggestionOnSuccess(response) {

  response.forEach(function (suggestion) {
    var suggestionElement = `
          <div class="my-2 shadow text-white bg-dark p-1" id="suggestion_${suggestion.id}">
            <div class="d-flex justify-content-between">
              <table class="ms-1">
                <td class="align-middle">${suggestion.name}</td>
                <td class="align-middle"> - </td>
                <td class="align-middle">${suggestion.email}</td>
              </table>
              <div>
                <button class="btn btn-primary me-1" onclick="inviteRequest('${suggestion.id}')">Connect</button>
              </div>
            </div>
          </div>
        `;
        
        $('#content').append(suggestionElement);
        $('#content').removeClass('d-none');
  });
}

function sentRequestOnSuccess(response) {
  response.data.forEach(function (suggestion) {
    var suggestionElement = `
          <div class="my-2 shadow text-white bg-dark p-1" id="withdraw_request_${suggestion.id}">
            <div class="d-flex justify-content-between">
              <table class="ms-1">
                <td class="align-middle">${suggestion.name}</td>
                <td class="align-middle"> - </td>
                <td class="align-middle">${suggestion.email}</td>
              </table>
              <div>
              <button id="cancel_request_btn_" class="btn btn-danger me-1"
              onclick="withdrawRequest('${suggestion.id}')">Withdraw Request</button>

              </div>
            </div>
          </div>
          <div>
        
        `;

        $('#content').append(suggestionElement);
        $('#content').removeClass('d-none');
  });
}

function recievedRequestOnSuccess(response) {
  response.data.forEach(function (suggestion) {
    var suggestionElement = `
          <div class="my-2 shadow text-white bg-dark p-1" id="invite_request_${suggestion.id}">
            <div class="d-flex justify-content-between">
              <table class="ms-1">
                <td class="align-middle">${suggestion.name}</td>
                <td class="align-middle"> - </td>
                <td class="align-middle">${suggestion.email}</td>
              </table>
              <div>
              <button id="cancel_request_btn_" class="btn btn-danger me-1"
              onclick="acceptInvitation('${suggestion.id}')">Accept</button>

              </div>
            </div>
          </div>
          <div>
        
        `;

        $('#content').append(suggestionElement);
        $('#content').removeClass('d-none');
  });
}

function connectionOnSuccess(response){
  console.log(response);
  response.data.forEach(function (suggestion) {
    var suggestionElement = `
    <div class="my-2 shadow text-white bg-dark p-1" id="connection_${suggestion.id}">
      <div class="d-flex justify-content-between">
        <table class="ms-1">
          <td class="align-middle">${suggestion.name}</td>
          <td class="align-middle"> - </td>
          <td class="align-middle">${suggestion.email}</td>
          <td class="align-middle">
        </table>
        <div>
          <button style="width: 220px" id="get_connections_in_common_" class="btn btn-primary" type="button"
            data-bs-toggle="collapse" data-bs-target="#collapse_" aria-expanded="false" aria-controls="collapseExample">
            Connections in common ()
          </button>
          <button id="create_request_btn_" class="btn btn-danger me-1" onclick="removeConnection('${suggestion.id}')">Remove Connection</button>
        </div>

      </div>
    </div>
  `
  $('#content').append(suggestionElement);
  $('#content').removeClass('d-none');
  });
}


function inviteRequest(id){

  SimpleAjax(`/send-invite/${id}`, 'POST', alert('user invited successfully') );
  $("#suggestion_" + id).remove();
}

function withdrawRequest(id){

  var form = new FormData();
  form.append('status', 'withdrawn');
  form.append('user_id', user_id);
 
  SimpleAjax(`/sent-requests/update/${id}`, 'POST', alert('request withdrawn successfully'), form);
  $("#withdraw_request_" + id).remove();
}

function removeConnection(id) {
  SimpleAjax(`/connections/${id}`, 'POST', alert('connection Removed successfully'));
  $("#withdraw_request_" + id).remove();
}

function acceptInvitation(id)
{
  var form = new FormData();
  form.append('status', 'approved');

  SimpleAjax(`/recieved-requests/update/${id}`, 'POST', alert('request withdrawn successfully'), form);
  $("#invite_request_" + id).remove();
}


$(function () {
  getSuggestions();
});