import styled from 'styled-components';
import {media} from './mixins';

export const Container = styled.div`
    max-width: 750px;
    margin: 0 auto;
    background-color: #ccc;
    ${media.laptop`
        max-width: 970px;
    `}
    ${media.desktop`
        max-width: 1170px;
    `}
`;
