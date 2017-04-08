import * as actionTypes from '../actions-types/notebooks';

const initialState = {
    data: [],
    isLoading: false,
    error: false
};

export default function notebooks(state = initialState, action) {
    switch(action.type) {
        case actionTypes.FETCH_NOTEBOOKS_REQUEST:
            return {
                ...state,
                isLoading: true
            };

        case actionTypes.FETCH_NOTEBOOKS_SUCCESS:
            return {
                ...state,
                data: action.payload,
                isLoading: false
            };

        case actionTypes.FETCH_NOTEBOOKS_FAILURE:
            return {
                ...state,
                error: action.payload
            };

        default:
            return state;
    }
}