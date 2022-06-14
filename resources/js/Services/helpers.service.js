export const excerpt = (text, size = 20, suffix = '...') => {
    return text.length > size + suffix.length ? text.substr(0, size) + suffix : text;
}

export const formatDatetime = (datetime) => {
    const date = new Date(datetime);
    return date.toLocaleTimeString('en-us', { weekday:"long", year:"numeric", month:"short", day:"numeric"}) 
}