import React from 'react';
import {Link} from 'react-router';
import styled from 'styled-components';

import {Container} from '../../libs/blocks';
import {colors, fontSizes} from '../../libs/variables';
import {media} from '../../libs/mixins';


const FormStyled = styled.section`
`;
const FormBlock = styled.section`
`;
const FormBlock__Header = styled.header`
    padding: 5px 0;
    border-bottom: 1px solid ${colors.minor};
    font-size: ${fontSizes.m};
    font-weight: 300;
`;

export default class Form extends React.Component {

    render() {
        return (
            <FormStyled>
                <FormBlock>
                    <FormBlock__Header>Основные данные</FormBlock__Header>
                </FormBlock>
            </FormStyled>
        )
    }
}
