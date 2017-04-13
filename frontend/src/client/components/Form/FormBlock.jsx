import React from 'react';
import styled from 'styled-components';

import {colors, fontSizes} from '../../libs/variables';

const FormBlockStyled = styled.section`
`;
const Header = styled.header`
    padding: 5px 0;
    border-bottom: 1px solid ${colors.minor};
    font-size: ${fontSizes.m};
    font-weight: 300;
`;
const Content = styled.section`
    margin: 15px 0;
`;

export default class FormBlock extends React.Component {

    render() {
        return (
            <FormBlockStyled>
                <Header>{this.props.title}</Header>
                <Content>{this.props.children}</Content>
            </FormBlockStyled>
        )
    }
}
