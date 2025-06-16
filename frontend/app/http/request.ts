const get = async (url: string)=> {
    const response = await fetch(process.env.NEXT_PUBLIC_BACKEND_URL + url);
    return await response.json();
}

const post = async (url: string, data: any)=> {
    return await fetch(process.env.NEXT_PUBLIC_BACKEND_URL + url, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    });
}

export default { get, post };