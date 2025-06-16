const getAuth = async (url: string, token: string)=> {
    return await fetch(process.env.NEXT_PUBLIC_BACKEND_URL + url, {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token
        }
    });
}

const postAuth = async (url: string, data: object, token: string)=> {
    return await fetch(process.env.NEXT_PUBLIC_BACKEND_URL + url, {
        method: 'POST',
        body: JSON.stringify(data),
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token
        }
    });
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

const checkLogin = async (token: string) => {
    const response = await fetch(process.env.NEXT_PUBLIC_BACKEND_URL + '/user', {
        method: 'GET',
        headers: {
            'Accept': 'application/json',
            'Content-Type': 'application/json',
            'Authorization': 'Bearer ' + token
        }
    });
    if (response.status === 200) {
        const user = await response.json();
        localStorage.setItem('userId', user.id);
    }
    return response.ok;
}

export default { getAuth, postAuth, post, checkLogin };