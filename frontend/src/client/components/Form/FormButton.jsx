import React from 'react';
import {Link} from 'react-router';
import styled from 'styled-components';

import {colors, fontSizes} from '../../libs/variables';

const FormButtonStyled = styled(Link)`
    display: inline-block;
    font-size: ${fontSizes.s};
    background-color: ${colors.main};
    border: none;
    padding: 5px 10px;
    color: ${colors.white};
    text-decoration: none;
    font-weight: 500;
`;

export default class FormButton extends React.Component {

    render() {
        return (
            <FormButtonStyled onClick={this.props.handleClick}>{this.props.title}</FormButtonStyled>
        )
    }
}
