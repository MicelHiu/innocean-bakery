const headers = {
    Accept: 'application/json', 'Content-Type':'application/json'
};

async function request(url, options={})
{
    const res = await fetch(url, { headers, ...options });
    const body = await res.json().catch(() => ({}));

    if(!res.ok) {
        const error = new Error(body.message ?? 'Request failed');
        error.status = res.status;
        error.errors = body.errors ?? {};
        throw error;
    }

    return body.data ?? body;
}

export const getStores = () => request('/api/stores');

export const getProducts = (storeId, signal) => request(`/api/stores/${encodeURIComponent(storeId)}/products`, {signal});

export const getSubmissions = () => request('/api/submissions');

export const createSubmission = (payload) => request('/api/submissions', { method: 'POST', body: JSON.stringify(payload) });
