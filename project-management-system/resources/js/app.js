import './bootstrap';

window.clearAndSubmit = function (formId, fields) {
    const form = document.getElementById(formId);
    fields.forEach((name) => {
        const el = form.querySelector(`[name="${name}"]`);
        if (!el) return;
        el.value = '';         // Clear value
        el.disabled = true;    // Prevent empty params in URL
    });
    form.submit();
};