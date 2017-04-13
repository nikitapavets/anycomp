import * as cookie from "../config/cookie";
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
            console.log(action.payload);
            return {
                ...state,
                current: action.payload,
                isLoading: false
            };

        case actionTypes.FETCH_USER_FAILURE:
            return {
                ...state,
                error: action.payload
            };

        case actionTypes.CHECK_AUTH_USER:
            return {
                ...state,
                current: cookie.load(cookie.USER_COOKIE)
            };

        case actionTypes.REGISTRATION_USER:
            return {
                ...state,
                isLoading: true
            };

        case actionTypes.LOGIN_USER:
            return {
                ...state
            };

        case actionTypes.LOGOUT_USER:
            return {
                ...state
            };

        default:
            return state;
    }
}
