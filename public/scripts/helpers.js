const fetchUrl = document.location.origin+'/endPoint';
//supported methods
const post = "POST"; //to retrieve data from server
const del = "DELETE"; //to delete record
const put = "PUT"; //to put record in db


const fetchData = async (data, requestMethod) => {

    const response = await fetch(fetchUrl, {
        method: requestMethod,
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });

    if (! response.ok) {
        console.error(`An error has occurred: ${response.status}`);
        return [];
    }
    if(response.status === 204 || response.status === 418) { //no-content
        return [];  //empty json file;
    }
    return response.json();
}

function addMultipleEvents(element, eventNames, func) {
    let events = eventNames.split(' ');
    events.map(event => {
        element.addEventListener(event, func, false);
    })
}

export {fetchData, addMultipleEvents, post, del, put}