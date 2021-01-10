const url = 'http://localhost:8080';
const fetchData = async (data, urlAppend) => {
    const fetchUrl = url+urlAppend
    const response = await fetch(fetchUrl, {
        method: "POST",
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    });

    if (! response.ok) {
        const message = `An error has occured: ${response.status}`;
        throw new Error(message);
    }
    return await response.json();
}

const postData = async (data, urlAppend) => {}

export {fetchData}