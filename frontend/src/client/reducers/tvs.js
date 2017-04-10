import * as actionTypes from '../actions-types/tvs';

const initialState = {
    data: [],
    isLoading: false,
    error: false
};

export default function tvs(state = initialState, action) {
    switch(action.type) {
        case actionTypes.FETCH_TVS_REQUEST:
            return {
                ...state,
                isLoading: true
            };

        case actionTypes.FETCH_TVS_SEARCH:
            return {
                ...state,
                isLoading: true
            };

        case actionTypes.FETCH_TVS_SUCCESS:
            return {
                ...state,
                data: action.payload,
                isLoading: false
            };

        case actionTypes.FETCH_TVS_FAILURE:
            return {
                ...state,
                error: action.payload
            };

        default:
            return state;
    }
}