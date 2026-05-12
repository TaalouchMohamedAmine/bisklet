const API_BASE = import.meta.env.VITE_BACKEND_PROXY ?? "/backend";

let csrfToken = null;

async function loadCsrfToken() {
  if (csrfToken) {
    return csrfToken;
  }

  const response = await fetch(`${API_BASE}/csrf-token`, {
    credentials: "include",
    headers: {
      Accept: "application/json",
      "X-Requested-With": "XMLHttpRequest",
    },
  });

  const payload = await response.json();

  csrfToken = payload.token;

  if (!csrfToken) {
    throw new Error("Unable to read the Laravel CSRF token.");
  }

  return csrfToken;
}

function validationMessages(payload) {
  if (!payload?.errors) {
    return {};
  }

  return Object.fromEntries(
    Object.entries(payload.errors).map(([key, value]) => [
      key,
      Array.isArray(value) ? value[0] : value,
    ]),
  );
}

export async function submitLaravelForm(path, values) {
  const token = await loadCsrfToken();
  const formData = new FormData();

  Object.entries(values).forEach(([key, value]) => {
    if (value !== undefined && value !== null) {
      formData.append(key, value);
    }
  });

  const response = await fetch(`${API_BASE}${path}`, {
    method: "POST",
    credentials: "include",
    headers: {
      Accept: "application/json",
      "X-CSRF-TOKEN": token,
      "X-Requested-With": "XMLHttpRequest",
    },
    body: formData,
  });

  if (response.status === 419) {
    csrfToken = null;
    throw new Error("Your session expired. Please submit the form again.");
  }

  const contentType = response.headers.get("content-type") ?? "";
  const payload = contentType.includes("application/json")
    ? await response.json()
    : {};

  if (!response.ok) {
    const errors = validationMessages(payload);
    const message =
      Object.values(errors)[0] ??
      payload.message ??
      "The request could not be completed.";

    return { ok: false, errors, message };
  }

  return { ok: true, payload };
}

export async function getCurrentUser() {
  const response = await fetch(`${API_BASE}/auth/user`, {
    credentials: "include",
    headers: {
      Accept: "application/json",
      "X-Requested-With": "XMLHttpRequest",
    },
  });

  if (!response.ok) {
    return null;
  }

  const payload = await response.json();
  return payload.user ?? null;
}

export function backendUrl(path) {
  return `${API_BASE}${path}`;
}
