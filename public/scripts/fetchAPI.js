const fetchUrl = 'http://localhost:8080/fetchData';
const fetchData = async (data) => {
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

export {fetchData}