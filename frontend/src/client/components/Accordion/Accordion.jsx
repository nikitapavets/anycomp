import React from 'react';
import styled from 'styled-components';

const AccordionStyled = styled.div``;

export default class Accordion extends React.Component {
    constructor(props) {
        super(props);

        this.state = {
            panelsFuncs: [],
            activePanelNumber: 0
        }
    }

    static defaultProps = {
        activePanel: 0,
        lockClick: true
    };

    componentWillMount() {
        this.props.initAccordion(this.activateNextPanel);
    }

    initPanels = (panelActivateFunc, panelHideFunc) => {
        this.setState(_ => ({
            panelsFuncs: [..._.panelsFuncs, {activate: panelActivateFunc, hide: panelHideFunc}]
        }));
    };

    activatePanel = (panelNumber) => {
        this.state.panelsFuncs.map((panelFunc, number) => {
                if (panelNumber == number) {
                    panelFunc.activate()
                } else {
                    panelFunc.hide();
                }
            }
        );
        this.setState({
            activePanelNumber: panelNumber
        });
    };

    activateNextPanel = () => {
        this.activatePanel(this.state.activePanelNumber + 1);
    };

    render() {
        const childrenWithProps = React.Children.map(this.props.children,
            (child, number) => React.cloneElement(child, {
                initPanels: this.initPanels,
                activatePanel: this.activatePanel,
                panelNumber: number,
                active: this.props.activePanel == number,
                lockClick: this.props.lockClick
            })
        );

        return (
            <AccordionStyled>
                {childrenWithProps}
            </AccordionStyled>
        )
    }
}
