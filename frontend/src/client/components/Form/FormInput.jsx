import React from 'react';
import styled from 'styled-components';

import {colors, fontSizes} from '../../libs/variables';
import {media} from '../../libs/mixins';

const FormInputStyled = styled.div`
    ${media.tablet`
        display: flex;
        margin: 15px 0;
    `}
`;
const Title = styled.div`
    margin: 10px 0;
    font-size: ${fontSizes.s};
    &:after {
        content: ${props => props.required ? '"*"' : '""'};
        display: inline-block;
        color: ${colors.red};
    }
    ${media.tablet`
        flex: 1 1;
    `}
`;
const Field = styled.div`
    ${media.tablet`
        flex: 2 1;
    `}
`;
const Input = styled.input`
    display: block;
    width: 100%;
    padding: 7px 10px;
    background: rgba(0, 0, 0, .05);
    border: none;
    outline: none;
    border: 2px solid rgba(0, 0, 0, .05);
    &:focus {
        border: 2px solid ${colors.minor};
    }
`;
const Error = styled.div`
    font-size: ${fontSizes.xs};
    color: ${colors.red};
    margin-top: 5px;
`;

export default class FormInput extends React.Component {

    static propTypes = {
        title: React.PropTypes.string
    };

    render() {
        return (
            <FormInputStyled>
                <Title required={this.props.required}>{this.props.title}</Title>
                <Field>
                    <Input name={this.props.name}
                           data-validate={this.props.validate}
                           data-required={this.props.required}/>
                    <Error className='error'/>
                </Field>
            </FormInputStyled>
        )
    }
}
