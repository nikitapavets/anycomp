export default function lang(state = {}, action) {
    if (action.type === 'INIT_LANG') {
        return action.payload;
    }
    return state;
}
