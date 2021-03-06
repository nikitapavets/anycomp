import React from 'react';
import styled from 'styled-components';

import {colors, fontSizes} from '../../libs/variables';

const FormCheckboxStyled = styled.label`
    display: flex;
    position: relative;
    align-items: center;
    cursor: pointer;
`;
const Input = styled.input`
    position: absolute;
    top: 4px;
    left: 4px;
    opacity: 0;
`;
const FakeInput = styled.div`
    display: inline-block;
    position: relative;
    width: 20px;
    height: 20px;
    border-radius: 10em;
    &:before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 20px;
        height: 20px;
        border: none;
        border-radius: 10em;
        background: ${colors.minor};
    }
    &:after {
        display: ${props => props.isActive ? 'block' : 'none'};
        content: '';
        position: absolute;
        top: 4px;
        left: 4px;
        width: 12px;
        height: 12px;
        border-radius: 10em;
        background: ${colors.main};
    }
`;
const Title = styled.div`
    font-size: ${fontSizes.xs};
    margin-left: 15px;
`;

export default class FormInputRadio extends React.Component {

    constructor(props) {
        super(props);

        this.state = {
            isActive: props.active
        };
    }

    componentWillMount() {
        this.props.collectRadioFlushFunc(this.flushActiveStatus);
    }

    handleClick = () => {
        this.props.flushRadioCollection();
        this.setState(_ => ({
            isActive: !_.isActive
        }));
    };

    flushActiveStatus = () => {
        this.setState({
            isActive: false
        });
    };

    static propTypes = {
        name: React.PropTypes.string.isRequired,
        value: React.PropTypes.string.isRequired,
        title: React.PropTypes.string
    };

    static defaultProps = {
        active: false
    };

    render() {
        return (
            <FormCheckboxStyled htmlFor={this.props.value}>
                <Input type='radio' name={this.props.name} id={this.props.value} value={this.props.value} defaultChecked={this.props.active ? 'checked' : ''}/>
                <FakeInput isActive={this.state.isActive}/>
                <Title onClick={this.handleClick}>{this.props.title}</Title>
            </FormCheckboxStyled>
        )
    }
}
