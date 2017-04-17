import React from 'react';
import {Link} from 'react-router';
import styled from 'styled-components';

import {colors, fontSizes} from '../../libs/variables';

const PanelStyled = styled.section`
    border: 1px solid ${colors.minor};
    margin: 5px 0;
`;
const Panel__Header = styled(Link)`
    display: block;
    padding: 15px;
    background: ${colors.minor};
    font-weight: 500;
    cursor: pointer;
    border-bottom: 1px solid ${colors.minor};
    text-decoration: none;
`;
const Panel__Inner = styled.div`
    padding: 15px;
`;

export default class Panel extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            active: props.active
        }
    }

    static defaultProps = {
        header: 'Заголовок',
        active: false,
        lockClick: false
    };

    componentWillMount() {
        this.props.initPanels(this.activate, this.hide);
    }

    handleClick = (e) => {
        if(!this.props.lockClick) {
            this.props.activatePanel(this.props.panelNumber);
        }

        e.preventDefault();
    };

    activate = () => {
        this.setState({
            active: true
        });
    };

    hide = () => {
        this.setState({
            active: false
        });
    };

    render() {
        return (
            <PanelStyled>
                <Panel__Header to='#' onClick={this.handleClick}>{this.props.header}</Panel__Header>
                {this.state.active &&
                <Panel__Inner>{this.props.children}</Panel__Inner>
                }
            </PanelStyled>
        )
    }
}
