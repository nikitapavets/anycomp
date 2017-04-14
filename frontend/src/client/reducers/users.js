import * as actionTypes from '../actions-types/users';

const initialState = {
    data: [],
    current: {},
    isLoading: false,
    error: false
};

export default function notebooks(state = initialState, action) {
    switch (action.type) {
        case actionTypes.FETCH_USER_GET:
            return {
                ...state,
                isLoading: true
            };

        case actionTypes.FETCH_USER_SUCCESS:
            return {
                ...state,
                current: action.payload,
                isLoading: false,
                error: initialState.error
            };

        case actionTypes.FETCH_USER_FAILURE:
            return {
                ...state,
                current: initialState.current,
                error: action.payload,
                isLoading: false
            };

        case actionTypes.CHECK_AUTH_USER:
            return {
                ...state,
                isLoading: true
            };

        case actionTypes.REGISTRATION_USER:
            return {
                ...state,
                isLoading: true
            };

        case actionTypes.LOGIN_USER:
            return {
                ...state,
                isLoading: true
            };

        case actionTypes.LOGOUT_USER:
            return {
                ...state,
                current: initialState.current
            };

        default:
            return state;
    }
}
