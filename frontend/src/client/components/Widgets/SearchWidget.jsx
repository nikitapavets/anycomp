import React from 'react';
import styled from 'styled-components';
import {colors} from '../../libs/variables';
import {bgi} from '../../libs/mixins';

const SearchImg = require('../../../../static/images/svg/search.svg');
const SearchWidgetStyled = styled.div`
    position: relative;
    &:after {
        content: '';
        position: absolute;
        right: 15px;
        top: 11px;
        ${bgi(SearchImg, 16)}
    }
`;
const Search = styled.input`
    width: 100%;
    padding: 10px 35px 10px 10px;
    border: none;
    outline: none;
    background-color: ${colors.minor};
`;

const ENTER_KEY_CODE = 13;
export default class SearchWidget extends React.Component {

    handleSend = (e) => {
        if (e.keyCode == ENTER_KEY_CODE) {
            this.props.handleSend({text: e.target.value});
        }
    };

    render() {
        return (
            <SearchWidgetStyled>
                <Search onKeyUp={this.handleSend} type='text'/>
            </SearchWidgetStyled>
        );
    }
}
